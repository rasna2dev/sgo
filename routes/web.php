<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ImagemController;
use App\Http\Controllers\UploadImoveisController;
use App\Http\Controllers\AtualizaImoveisLotController;
use App\Http\Controllers\AtualizaFotoImoveisLotController;
use App\Http\Controllers\ImoveisController;
use App\Http\Controllers\TarifasController;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\LoginController;


Route::prefix('/')
    ->group(function () {
    Route::get('/404', [IndexController::class, 'erro404'])->name('erro_404');
    Route::get('/', [IndexController::class, 'index'])->name('site');
    Route::get('/foto/{imagem}', [ImagemController::class, 'index'])->name('imagem');
    Route::get('/oportunidade/{matricula}', [IndexController::class, 'oportunidade'])->name('oportunidade');
    Route::get('/saiba-mais/{matricula}', [IndexController::class, 'saibamais'])->name('saibamais');
});


Route::prefix('app')
    ->group(function () {
    Route::get('/', [LoginController::class, 'index'])->name('login');
    Route::get('/sair', [LoginController::class, 'sair'])->name('sair');
    Route::post('/',[LoginController::class, 'validar'])->name('validar');
});

Route::middleware(['auth'])
    ->name('sgo.')
    ->prefix('app')
    ->group(function () {

        Route::resource('/add-imoveis', UploadImoveisController::class)->only([
            'index'
            ,'store'
        ])->names([
            'index' => 'add-imoveis.index'
            ,'store' => 'add-imoveis.store'
        ]);

        Route::resource('/upd-imoveis', AtualizaImoveisLotController::class)->only([
            'index'
            ,'update'
        ])->names([
            'index' => 'upd-imoveis.index'
            ,'update' => 'upd-imoveis.update'
        ]);

        Route::resource('/dwn-fotos', AtualizaFotoImoveisLotController::class)->only([
            'index'
            ,'update'
        ])->names([
            'index' => 'dwn-fotos.index'
            ,'update' => 'dwn-fotos.update'
        ]);

        Route::resource('/imoveis', ImoveisController::class)->only([
            'index'
        ])->names([
            'index' => 'imoveis.index'
        ]);

        Route::resource('/tarifas', TarifasController::class)->only([
            'index'
            ,'store'
            ,'update'
            ,'destroy'
        ])->names([
            'index' => 'tarifas.index'
            ,'store' => 'tarifas.store'
            ,'update' => 'tarifas.update'
            ,'destroy' => 'tarifas.destroy'
        ])
        ->middleware('can:sa-access');

        Route::resource('/usuarios', UsuariosController::class)->only([
            'index'
            ,'store'
            ,'update'
        ])->names([
            'index' => 'usuarios.index'
            ,'store' => 'usuarios.store'
            ,'update' => 'usuarios.update'
        ])
        ->middleware('can:admin-access');

        Route::resource('/perfil', PerfilController::class)->only([
            'index'
            ,'update'
        ])->names([
            'index' => 'perfil.index'
            ,'update' => 'perfil.update'
        ]);

});
