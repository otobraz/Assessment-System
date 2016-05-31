<?php

   return [

      // The UFOP LDAP information to connect and retrieve the necessary fields from the users
      'ldapData' => [

         'server'  => '200.239.152.140',
         'domain' => 'dc=ufop,dc=br',
         'cn' => 'cn=arp',
         'password' => 'dGgwMTIz',
         'id_field' => 'uid',
         'password_field' => 'userpassword',
         'given_name_field' => 'cn',
         'last_name_field' => 'sn',
         'email_field' => 'mail',
         'group_field' => 'ou'

      ],

      // The type of users based on their groups (the 'o' field in LDAP)
      'userGroups' => [

         // Students
         'ENGENHARIA DE COMPUTACAO' => 1,
         'ENGENHARIA DE PRODUCAO' => 1,
         'ENGENHARIA ELETRICA' => 1,
         'SISTEMAS DE INFORMACAO' => 1,

         // Professors
         'DEPARTAMENTO DE CIENCIAS EXATAS E APLICADAS' => 2,
         'DEPARTAMENTO DE COMPUTACAO E SISTEMAS' => 2,
         'DEPARTAMENTO DE ENGENHARIA DE PRODUCAO - ICEA' => 2,
         'DEPARTAMENTO DE ENGENHARIA ELETRICA' => 2,
         'INSTITUTO DE CIENCIAS EXATAS E APLICADAS' => 2
         
      ]
   ]

?>
