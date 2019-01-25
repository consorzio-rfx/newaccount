<?php
namespace AppBundle\Services;

class GetUserAttributes {

    public function __construct($ldapServer, $ldapServerPort, $ldapSearchUser, $ldapSearchPassword, $ldapSearchBaseDn) {
	$this->ldapServer = $ldapServer;
	$this->ldapServerPort = $ldapServerPort;
	$this->ldapSearchUser = $ldapSearchUser;
	$this->ldapSearchPassword = $ldapSearchPassword;
	$this->ldapSearchBaseDn = $ldapSearchBaseDn;
    }

    public function getAttributes($username) {
        $attributes = $this->getLDAPAttributes($username);
        $usernameData['name'] = $attributes['name'];
        $usernameData['surname'] = $attributes['surname'];
        $usernameData['email'] = $attributes['email'];
        return $usernameData;
    }

    protected function getLDAPAttributes($username) {
        $ldapServer = $this->ldapServer;
	$ldapServerPort = $this->ldapServerPort;
	$ldapUser = $this->ldapSearchUser;
        $ldapPassword = $this->ldapSearchPassword;
	$ldapSearchBaseDn = $this->ldapSearchBaseDn;

        $ldapSearchFilter = "(cn=" . $username . ")";
        $attributes['name'] = "noname";
        $attributes['surname'] = "nosurname";
	$attributes['email'] = "nomail";

        $ds=ldap_connect($ldapServer, $ldapServerPort);
	$r=ldap_bind($ds, $ldapUser, $ldapPassword);
        $returnError = ldap_errno($ds);
        if (! $r) {
	    // echo ldap_err2str( $returnError );
	        //  echo " (Error code: ".$returnError.")\n";
            ldap_close($ds);
	        return $attributes;
		}

       $sr=ldap_search($ds, $ldapSearchBaseDn, $ldapSearchFilter);
        $info = ldap_get_entries($ds, $sr);

	//var_dump($username);
        //var_dump(count($info));

        if (count($info) > 1) {
           $attributes['name'] = $info[0]['givenname'][0];
	      $attributes['surname'] = $info[0]['sn'][0];
	         $attributes['email'] = $info[0]['mail'][0];
        }

	return $attributes;
    }

}
