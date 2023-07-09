<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redis;
use App\Jobs\CheckInstallationJob;

class CheckInstallation
{
    public function handle($request, Closure $next)
    {
        if (!$this->isInstalled()) {
            return view('pages.admin.instalace');
        }

        return $next($request);
    }

    private function isInstalled()
    {
        $envFile = base_path('.env');

        if (File::exists($envFile)) {
            $envContents = File::get($envFile);
            return strpos($envContents, 'INSTALACE=true') !== false;
        }

        return false;
    }
}
