<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;

class InstalaceController extends Controller
{
    public function index()
    {
        if (env('INSTALACE') == true) {
            return redirect('/admin/panel');
        } else {
            return view('pages.admin.instalace');
        }
    }

    public function store(Request $request)
    {
        // Zde zpracujte odeslaná data z formuláře instalace

        $dbHost = $request->input('db_host');
        $dbName = $request->input('db_name');
        $dbUser = $request->input('db_user');
        $dbPassword = $request->input('db_password');
        $adminName = $request->input('admin_name');
        $adminEmail = $request->input('admin_email');
        $adminPassword = $request->input('admin_password');
        $websiteName = $request->input('website_name');
        $websiteDescription = $request->input('website_description');


        // Zkontrolujte připojení k databázi
        try {
            Config::set('database.connections.mysql.host', $dbHost);
            Config::set('database.connections.mysql.database', $dbName);
            Config::set('database.connections.mysql.username', $dbUser);
            Config::set('database.connections.mysql.password', $dbPassword);
            DB::connection()->getPdo();
        } catch (\Exception $e) {
            return redirect('/admin/instalace')->with('error', 'Nepodařilo se připojit k databázi. Zkontrolujte prosím zadané údaje.');
        }

        // Uložte hodnoty do .env souboru
        $envFile = base_path('.env');
        $envContent = File::get($envFile);

        // Aktualizujte hodnoty v .env souboru
        $envContent = str_replace([
            'INSTALACE=false',
            'DB_HOST=127.0.0.1',
            'DB_DATABASE=actorcms',
            'DB_USERNAME=root',
            'DB_PASSWORD='
        ], [
            'INSTALACE=true',
            'DB_HOST=' . $dbHost,
            'DB_DATABASE=' . $dbName,
            'DB_USERNAME=' . $dbUser,
            'DB_PASSWORD=' . $dbPassword
        ], $envContent);

        // Uložte aktualizovaný obsah .env souboru
        File::put($envFile, $envContent);

        try {
            $settingsTable = 'settings';
            if (!Schema::hasTable($settingsTable)) {
                Schema::create($settingsTable, function ($table) {
                    $table->increments('id');
                    $table->string('name');
                    $table->string('description')->nullable();
                    $table->timestamps();
                });
            }

            // Vytvořte tabulku pro správce, pokud neexistuje
            $adminTable = 'admins';
            if (!Schema::hasTable($adminTable)) {
                Schema::create($adminTable, function ($table) {
                    $table->increments('id');
                    $table->string('name');
                    $table->string('email')->unique();
                    $table->string('password');
                    $table->rememberToken();
                    $table->timestamps();
                });
            }

            $postsTable = "posts";
            if (!Schema::hasTable($postsTable)) {
                Schema::create($postsTable, function ($table) {
                    $table->id();
                    $table->string('title');
                    $table->string('content');
                    $table->enum('type', ['film', 'serial', 'divadlo']);
                    $table->string('slug')->unique();
                    $table->timestamps();
                });
            }

            // Vložte nastavení webu do tabulky
            DB::table($settingsTable)->insert([
                'name' => $websiteName,
                'description' => $request->input('website_description')
            ]);

            // Vložte údaje správce do tabulky
            $admin = DB::table($adminTable)->insertGetId([
                'name' => $adminName,
                'email' => $adminEmail,
                'password' => bcrypt($adminPassword)
            ]);

            return redirect('/admin/login')->with('success', 'Instalace byla úspěšně dokončena. Správce byl automaticky přihlášen.');
        } catch (\Exception $e) {
            return redirect('/admin/instalace')->with('error', 'Při manipulaci s databází nastala chyba.\n' . $e);
        }
    }
}
