<?php
define('SERVER', 'ldaps://ldapsupannappli.univ-poitiers.fr:636');
define('ROOT', 'ou=people,dc=univ-poitiers,dc=fr');

function auth_ldap($login, $pass, &$uid, &$prenom, &$nom) {
    $connex = ldap_connect(SERVER);
    ldap_set_option($connex, LDAP_OPT_PROTOCOL_VERSION, 3);

    if ($connex) {
        // Connexion anonyme pour rechercher l'utilisateur
        ldap_bind($connex);

        $req = 'supannAliasLogin=' . ldap_escape($login, '', LDAP_ESCAPE_FILTER);
        $res = ldap_search($connex, ROOT, $req);
        $datas = ldap_get_entries($connex, $res);

        if ($datas && $datas["count"] > 0) {
            $uid = $datas[0]['uid'][0];
            $dn = 'uid=' . $uid . ',' . ROOT;

            if (ldap_bind($connex, $dn, $pass)) {
                $prenom = $datas[0]['givenname'][0] ?? '';
                $nom = $datas[0]['sn'][0] ?? '';
                ldap_close($connex);
                return true;
            }
        }
        ldap_close($connex);
    }

    return false;
}
