<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class ImportUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:users {file}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Importing users into the DB';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $file = $this->argument('file');
        if(!file_exists($file)){
            $this->error("File not found");
            return 1;
        }
        $handle = fopen($file,'r');
        $header = fgetcsv($handle);
        while(($row = fgetcsv($handle)) !== false){
            [$user_id, $username, $email, $password] = $row;
            //Checking email valid or not
            if(!$this->isValidEmail($email)){
                Log::warning("Invalid Email: $email");
                continue;
            }
            //Checking username range 
            if(!$this->isValidUserName($username)){
                Log::warning("Invalid Username: $username");
                continue;
            }
            //Inserting records in the DB
            try {
                DB::table('users')->insert([
                    'user_id' => $user_id,
                    'username' => $username,
                    'email' => $email,
                    'password' => Hash::make($password),
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
               
            } catch (\Throwable $th) {
                Log::error("Database error Occured for email $email :".$th->getMessage());
            }

        }
        fclose($handle);
        $this->info("CSV Imported");
        return 0;
    }
    private function isValidEmail($email){
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }
    private function isValidUserName($username){
        return preg_match('/^[a-zA-Z0-9]{3,20}$/',$username);
    }
}
