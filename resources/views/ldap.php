<?php

 use Adldap\Laravel\Facades\Adldap;

	//searching user
	/*$search = Adldap::search()->where('cn', '=', 'Tran Trung Thien')->get();
	try {
			echo($search);
	} catch (Exception $e) {
		echo 'Error: ',  $e->getMessage(), "\n";
	}*/
	//echo '\n';*/
	// this is returning the correct user
	//echo($search);
	// Finding a user.
	 $user = Adldap::search()->users()->find('ThienTT');
	try {
			echo($user->cn[0]);
	} catch (Exception $e) {
		echo 'Error: ',  $e->getMessage(), "\n";
	}
   // return redirect()->to('login')
    //    ->withMessage('Hmm... Your username or password is incorrect');

/* 	 $users = Adldap::getDefaultProvider()->search()->users()->get();
	foreach ($users as $user) {
		try {
			//echo $user->samaccountname[0], "\n";
			//echo '</br>';
			$search = Adldap::search()->where('samaccountname', '=', $user->samaccountname[0])->get();
			try {
				echo($search),"\n";
                echo "\n";
                echo "\n";
			} catch (Exception $e) {
				//echo $user->samaccountname[0],' Error: ',"\n";
			}
		} catch (Exception $e) {
			//echo 'Error: ',  $e->getMessage(), "\n";
		}
		//$names[$user->cn[0]] = $user->displayname[0];
	} */
		
	//validate username/password
	if (Adldap::auth()->attempt('ThienTT@Eps.genco3.vn','Thien211292')) {
		echo('success');
	} else {
		echo('error');
	}

