<?php

namespace SISNTI\AutBundle\Services;

use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use SISNTI\AutBundle\Entity\UsuarioLDAP;
use Doctrine\ORM\EntityManager;

/**
 * Description of usuarioLDAPProvider
 *
 * @author plinio
 */
class UsuarioLDAPProvider implements UserProviderInterface {

    /**
     *
     * @var EntityManager
     */
    protected $em;

    public function __construct(EntityManager $entityManager) {
        $this->em = $entityManager;
    }

    public function loadUserByUsername($username) {
//        $user = $this->em->getRepository('AutBundle:Usuario')->findOneBy(array('cpf'=>$username));
//        if($user){
//            return $user;
//        }
        $configuracaoLDAP = $this->em->getRepository('AutBundle:ConfiguracaoLdap')->find(1);
        $entry = $this->carregarUsuarioLdap($configuracaoLDAP, $username);
        if ($entry != null) {
            $admins = $this->em->getRepository('AutBundle:Admins')->findOneBy(array("admincpf" => $username));
            $grupospermitidos = $this->em->getRepository('AutBundle:GruposPermitidos')->findOneBy(array("grupos" => $entry[0][$configuracaoLDAP->getGrupoprimario()][0]));
            $excecoes = $this->em->getRepository('AutBundle:Excecoes')->findOneBy(array("excecaocpf" => $username));
            if ($admins || $grupospermitidos || $excecoes) {
                if ($admins) { // Se o usuário encontrado for Admin
                    $pwd = substr($entry[0][$configuracaoLDAP->getPassword()][0], 5);
                    $usuarioLdap = new UsuarioLDAP($entry[0][$configuracaoLDAP->getIdentificador()][0],
                            $entry[0][$configuracaoLDAP->getPrimeironome()][0] . " " . $entry[0][$configuracaoLDAP->getUltimonome()][0],
                            $entry[0][$configuracaoLDAP->getEmail()][0], $pwd, $entry[0][$configuracaoLDAP->getTelefone()][0], "ROLE_ADMIN");

                    return $usuarioLdap;
                }
                $pwd = substr($entry[0][$configuracaoLDAP->getPassword()][0], 5);
                $usuarioLdap = new UsuarioLDAP($entry[0][$configuracaoLDAP->getIdentificador()][0],
                        $entry[0][$configuracaoLDAP->getPrimeironome()][0] . " " . $entry[0][$configuracaoLDAP->getUltimonome()][0],
                        $entry[0][$configuracaoLDAP->getEmail()][0], $pwd, $entry[0][$configuracaoLDAP->getTelefone()][0], "ROLE_USER");

                return $usuarioLdap;
            }
        }
        throw new UsernameNotFoundException(sprintf('Usuário "%s" não encontrado!', $username));
    }

    public function refreshUser(UserInterface $user) {
        if (!$user instanceof UsuarioLDAP) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', get_class($user)));
        }

        return $this->loadUserByUsername($user->getUsername());
    }

    public function supportsClass($class) {
        return $class === 'SISNTI\AutBundle\Entity\UsuarioLDAP';
    }

    public function carregarUsuarioLdap($configuracaoLDAP = null, $username = null) {
        $ds = ldap_connect($configuracaoLDAP->getServidor()); // your ldap server
        $bind = ldap_bind($ds, $configuracaoLDAP->getUsuarioleitor() . "," . $configuracaoLDAP->getDominio(), base64_decode($configuracaoLDAP->getSenhaleitor()));
        if ($bind) {
            $filter = "(" . $configuracaoLDAP->getIdentificador() . "=" . $username . ")"; // this command requires some filter
            $justthese = array($configuracaoLDAP->getIdentificador(),
               $configuracaoLDAP->getPrimeironome(),
               $configuracaoLDAP->getUltimonome(),
               $configuracaoLDAP->getEmail(),
               $configuracaoLDAP->getGrupoprimario(),
               $configuracaoLDAP->getTelefone(),
               $configuracaoLDAP->getPassword()
            ); // the attributes to pull, which is much more efficient than pulling all attributes if you don't do this
            $sr = ldap_search($ds, $configuracaoLDAP->getDominio(), $filter, $justthese);
            $entry = ldap_get_entries($ds, $sr);
            if ($entry['count'] > 0) {
                return $entry;
            }
            return null;
        }
        return null;
    }

}
