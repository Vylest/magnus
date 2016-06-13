<?php

namespace App\Http\Middleware;

use Closure;
use App\Gallery;
use Illuminate\Support\Facades\Auth;

class GalleryManagement
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $gallery_id = $request->route('gallery');
        $gallery = Gallery::where('id', $gallery_id)->first();

        if (Auth::user()->hasRole('admin') or Auth::user()->isOwner($gallery)) {
            return $next($request);
        } else {
            return redirect()->back()->withErrors('You are not permitted to complete that action or view that page.');
        }
    }
}
