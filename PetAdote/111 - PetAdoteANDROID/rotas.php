<?php
$url->rotas([
    //====================SITE====================\\
    'home'=>['acao'=>false,'pagina'=>'home'],
    


    //====================ANDROID====================\\

    // acesso
    'android_login'=>['acao'=>'android/acesso_login', 'pagina'=>false],
    'android_cadastro'=>['acao'=>'android/acesso_cadastro', 'pagina'=>false],

    // pets
    'android_pets'=>['acao'=>'android/pets', 'pagina'=>false],
    'android_pets_all'=>['acao'=>'android/pets_all', 'pagina'=>false],

    // meus pets
    'android_meus_pets'=>['acao'=>'android/meus_pets', 'pagina'=>false],
    'android_meus_pets_cadastro'=>['acao'=>'android/meus_pets_cadastro', 'pagina'=>false],
    'android_meus_pets_excluir'=>['acao'=>'android/meus_pets_excluir', 'pagina'=>false],
    'android_meus_pets_aceitar_adotante'=>['acao'=>'android/meus_pets_aceitar_adotante', 'pagina'=>false],

    // Adocao
    'android_entrar_lista_adocao'=>['acao'=>'android/adocao_entrar_lista', 'pagina'=>false],
    'android_sair_lista_adocao'=>['acao'=>'android/adocao_sair_lista', 'pagina'=>false],
    'android_adocao_listar'=>['acao'=>'android/adocao_listar', 'pagina'=>false],
    'android_adocao_historico'=>['acao'=>'android/adocao_historico', 'pagina'=>false]

  ]);
