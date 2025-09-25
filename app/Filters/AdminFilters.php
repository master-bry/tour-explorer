<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AdminFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        if (!service('auth')->check()) {
            return redirect()->to('/login')->with('error', 'Please login to access this page.');
        }

        $user = service('auth')->user();
        
        if (!service('authorization')->inGroup('admin', $user->id)) {
            return redirect()->to('/')->with('error', 'You do not have permission to access the admin area.');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}