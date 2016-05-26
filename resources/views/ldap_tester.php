<?php

$ldapConn = ldap_connect("200.239.152.140");

// Set some ldap options for talking to AD


//this is the LDAP admin account with access
$adminUsername = 'cn=arp,dc=ufop,dc=br';
$adminPassword = '';
$domain = "dc=ufop,dc=br";
$justThese = array("uid");

// Bind as a domain admin if they've set it up
if (md5($adminPassword) == "3ecfa30cf8e52c7b47f36c35f8a1a871"){
   $ldap_bind = ldap_bind($ldapConn, $adminUsername, $adminPassword);
}

//example path for searching
$search = ldap_search($ldapConn, $domain, "uid=09647636644", $justThese);

//example get command
$info = ldap_get_entries($ldapConn, $search);

echo 'ldap conn';
var_dump($ldapConn);

echo 'ldap bind';
var_dump($ldap_bind);

echo 'seach var';
var_dump($search);

echo 'search info';
var_dump($info);

ldap_unbind($ldapConn);
