<?php
define('SERVER', 'ldaps://ldapsupannappli.univ-poitiers.fr:636');
define('ROOT', 'ou=people,dc=univ-poitiers,dc=fr');

function auth_ldap($login, $pass, &$prenom, &$nom) {
    $connex = ldap_connect(SERVER);
    ldap_set_option($connex, LDAP_OPT_PROTOCOL_VERSION, 3);

    if (!$connex) return false;

    ldap_bind($connex);
    $req = 'supannAliasLogin=' . $login;
    $res = ldap_search($connex, ROOT, $req);
    $datas = ldap_get_entries($connex, $res);

    if (!$datas || !isset($datas[0]['uid'][0])) return false;

    $uid = $datas[0]['uid'][0];
    $dn = 'uid=' . $uid . ',' . ROOT;

    if (@ldap_bind($connex, $dn, $pass)) {
        $prenom = $datas[0]['givenname'][0];
        $nom = $datas[0]['sn'][0];
        return true;
    }

    return false;
}
