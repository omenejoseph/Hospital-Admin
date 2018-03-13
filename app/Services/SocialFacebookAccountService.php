<?php

namespace App\Services;
use App\SocialFacebookAccount;
use App\User;
use Laravel\Socialite\Contracts\User as ProviderUser;
use App\Photo;
use Illuminate\Support\Facades\File;


class SocialFacebookAccountService
{
    public function createOrGetUser(ProviderUser $providerUser)
    {
        $account = SocialFacebookAccount::whereProvider('facebook')
            ->whereProviderUserId($providerUser->getId())
            ->first();

        if ($account) {
            return $account->user;
        } else {

            $account = new SocialFacebookAccount([
                'provider_user_id' => $providerUser->getId(),
                'provider' => 'facebook'
            ]);

            $user = User::whereEmail($providerUser->getEmail())->first();

            if (!$user) {
                $user_id = $providerUser->getId();
                // $contents = File::get('https://graph.facebook.com/'.$user_id.'/picture');
                $fileContents = file_get_contents($providerUser->getAvatar());
                $file = File::put(public_path() . '/images/' . $user_id . ".jpg", $fileContents);
               
                $photo = Photo::create(['file_name' => $user_id . ".jpg", 'user_id'=>1]);

                $user = User::create([
                    'email' => $providerUser->getEmail(),
                    'name' => $providerUser->getName(),
                    'password' => md5(rand(1,10000)),
                    'photo_id' => $photo->id,
                ]);
            }

            $account->user()->associate($user);
            $account->save();

            return $user;
        }
    }
}