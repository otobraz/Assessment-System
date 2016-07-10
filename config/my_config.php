<?php

   return [

      // The UFOP LDAP information to connect and retrieve the necessary fields from the users
      'ldapData' => [

         'server'  => env('LDAP_SERVER', 'server'),
         'domain' => env('LDAP_DOMAIN', 'domain'),
         'cn' => env('LDAP_CN', 'cn'),
         'password' => env('LDAP_PASSWORD', 'password'),
         'id_field' => env('LDAP_ID_FIELD', 'idFieldName'),
         'password_field' => env('LDAP_PASSWORD_FIELD', 'passwordFieldName'),
         'given_name_field' => env('LDAP_NAME_FIELD', 'nameFieldName'),
         'last_name_field' => env('LDAP_LASTNAME_FIELD', 'lastnameFieldName'),
         'email_field' => env('LDAP_EMAIL_FIELD', 'emailFieldName'),
         'group_field' => env('LDAP_GROUP_FIELD', 'groupFieldName')

      ],

      // The type of users based on their groups (the 'o' field in LDAP)
      'userGroups' => [

         // Students
         'ENGENHARIA DE COMPUTACAO' => 2,
         'ENGENHARIA DE PRODUCAO' => 2,
         'ENGENHARIA ELETRICA' => 2,
         'SISTEMAS DE INFORMACAO' => 2,

         // Professors
         'DEPARTAMENTO DE CIENCIAS EXATAS E APLICADAS' => 3,
         'DEPARTAMENTO DE COMPUTACAO E SISTEMAS' => 3,
         'DEPARTAMENTO DE ENGENHARIA DE PRODUCAO - ICEA' => 3,
         'DEPARTAMENTO DE ENGENHARIA ELETRICA' => 3,
         'INSTITUTO DE CIENCIAS EXATAS E APLICADAS' => 3

      ]
   ]

?>
