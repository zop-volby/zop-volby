<?php

namespace App\Http\Controllers;

use App\Models\Voter;
use Firebase\JWT\JWT;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QrCodeController extends Controller
{
    public function index(string $id)
    {
        if (!$id) {
            return abort(404, 'Voter code not found.');
        }

        $voter = Voter::where('voter_code', $id)->first();
        if (!$voter) {
            return abort(404, 'Voter code not found.');
        }

        $key = config('voting.jwt_key');
        $payload = [
            'iss' => 'ZOP Volby',
            'sub' => $id,
            'aud' => 'voting execution',
            'exp' => time() + 60 * 60 * 24 * 120    // 120 days
        ];
        $jwt = JWT::encode($payload, $key, 'HS256');
        return QrCode::margin(10)->size(500)->generate($jwt);
    }
}