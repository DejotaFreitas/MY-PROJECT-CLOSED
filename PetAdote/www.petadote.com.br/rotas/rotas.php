<?php
URL::rotas([

//====================MENU GERAL====================\\
'home'=>['app'=>'petadote',  'acao'=>false,  'pagina'=>'home'],

//=======INSTITUICOES=======\\
'instituicoes'=>['app'=> 'petadote',  'acao'=>'instituicoes/instituicoes',  'pagina'=>'instituicoes'],
'instituicao'=>['app'=> 'petadote',  'acao'=>'instituicoes/instituicao',  'pagina'=>'instituicao'],
'ajax_get_parceiro_publico'=>['app'=> 'petadote',  'acao'=>'ajax/get_parceiro_publico',  'pagina'=>false],

//=======NOTICIAS=======\\
'noticias'=>['app'=>'petadote',  'acao'=>'noticias/noticias',  'pagina'=>'noticias'],
'cadastrando-noticia'=>['app'=>'petadote', 'acao'=>'noticias/cadastrando_noticia',  'pagina'=>'cadastrando-noticia'],
'cadastrar-noticia'=>['app'=>'petadote',  'acao'=>'noticias/cadastrar_noticia',  'pagina'=>'cadastrando-noticia'],
'apagar-noticia'=>['app'=>'petadote',  'acao'=>'noticias/apagar_noticia',  'pagina'=>'cadastrando-noticia'],
//=======PETS=======\\
'pets'=>['app'=>'petadote',  'acao'=>'pets/pets',  'pagina'=>'pets'],
'ajax_get_pet'=>['app'=>'petadote',  'acao'=>'ajax/get_pet',  'pagina'=>false],
'ajax_add_lista_adocao'=>['app'=>'petadote',  'acao'=>'ajax/add_lista_adocao',  'pagina'=>false],
'ajax_denucie_pet'=>['app'=>'petadote',  'acao'=>'ajax/denucie_pet',  'pagina'=>false],

//=======PERDIDOS=======\\
'perdidos'=>['app'=>'petadote',  'acao'=>'perdidos/perdidos',  'pagina'=>'perdidos'],
'ajax_dono_perdido'=>['app'=>'petadote',  'acao'=>'ajax/dono_perdido',  'pagina'=>false],

//=======ENCONTRADOS=======\\
'encontrados'=>['app'=>'petadote',  'acao'=>'encontrados/encontrados',  'pagina'=>'encontrados'],
'ajax_dono_encontrado'=>['app'=>'petadote',  'acao'=>'ajax/dono_encontrado',  'pagina'=>false],

//=======PARCEIROS=======\\
'parceiros'=>['app'=> 'petadote',  'acao'=>'parceiros/parceiros',  'pagina'=>'parceiros'],
'cadastrando-parceiro'=>['app'=> 'petadote',  'acao'=>'parceiros/cadastrando_parceiro',  'pagina'=>'cadastrando-parceiro'],
'cadastrar-parceiro'=>['app'=> 'petadote',  'acao'=>'parceiros/cadastrar_parceiro',  'pagina'=>'parceiros'],
'ajax_get_parceiro'=>['app'=> 'petadote',  'acao'=>'ajax/get_parceiro',  'pagina'=>false],
'ajax_excluir_parceiro'=>['app'=> 'petadote',  'acao'=>'ajax/excluir_parceiro',  'pagina'=>false],


//=======VINCULOS=======\\
'vinculos'=>['app'=>'petadote',  'acao'=>'vinculos/vinculos',  'pagina'=>'vinculos'],
'ajax_desvincular_pet'=>['app'=>'petadote',  'acao'=>'ajax/desvincular_pet',  'pagina'=>false],
'ajax_get_pet_vinculado'=>['app'=>'petadote',  'acao'=>'ajax/get_pet_vinculado',  'pagina'=>false],

//=======INTERESSADOS=======\\
'interessados'=>['app'=>'petadote',  'acao'=>'interessados/interessados',  'pagina'=>'interessados'],
'ajax_get_usuario_interessado'=>['app'=>'petadote',  'acao'=>'ajax/get_usuario_interessado',  'pagina'=>false],
'ajax_vinculo_aceitar'=>['app'=>'petadote',  'acao'=>'ajax/vinculo_aceitar',  'pagina'=>false],
'ajax_vinculo_recusar'=>['app'=>'petadote',  'acao'=>'ajax/vinculo_recusar',  'pagina'=>false],

//=======AJUDA=======\\
'ajuda'=>['app'=> 'petadote',  'acao'=>'ajuda/ajuda',  'pagina'=>'ajuda'],

//=======SAIR=======\\
'sair'=>['app'=>'petadote',  'acao'=>'sair/sair',  'pagina'=>'home'],

//=======ENTRAR=======\\
'entrar'=>['app'=>'petadote',  'acao'=>'entrar/entrar',  'pagina'=>'entrar'],
'entrar_logar'=>['app'=>'petadote',  'acao'=>'entrar/logar',  'pagina'=>'home'],
'ajax_entrar_email'=>['app'=>'petadote',  'acao'=>'ajax/entrar_email',  'pagina'=>false],
'ajax_entrar_senha'=>['app'=>'petadote',  'acao'=>'ajax/entrar_senha',  'pagina'=>false],

'recuperando-senha'=>['app'=>'petadote',  'acao'=>false,  'pagina'=>'recuperando-senha'],

'recuperando-senha-email-enviado'=>['app'=>'petadote',  'acao'=>'entrar/recuperando_senha_email_enviado',  'pagina'=>'recuperando-senha-email-enviado'],

'alterando-senha'=>['app'=>'petadote',  'acao'=>'entrar/alterando_senha',  'pagina'=>'alterando-senha'],

'alterar-senha'=>['app'=>'petadote',  'acao'=>'entrar/alterar_senha',  'pagina'=>'entrar'],
//=============MEUS=PETS===================\\
'meuspets'=>['app'=>'petadote',  'acao'=>'meuspets/meuspets',  'pagina'=>'meuspets'],
'cadastrando-pet'=>['app'=>'petadote',  'acao'=>'meuspets/cadastrando_pet',  'pagina'=>'cadastrando-pet'],
'cadastrar-pet'=>['app'=>'petadote',  'acao'=>'meuspets/cadastrar_pet',  'pagina'=>'meuspets'],
'ajax_get_pet_meu'=>['app'=>'petadote',  'acao'=>'ajax/get_pet_meu',  'pagina'=>false],
'ajax_excluir_meu_pet'=>['app'=>'petadote',  'acao'=>'ajax/excluir_meu_pet',  'pagina'=>false],

//=======PERFIL=======\\
'perfil'=>['app'=>'petadote',  'acao'=>'perfil/perfil',  'pagina'=>'perfil'],

'perfil-alterar-geral-foto'=>['app'=>'petadote',  'acao'=>'perfil/alterar_geral_foto',  'pagina'=>'perfil'],

'perfil-alterar-geral-pais-estado-cidade'=>['app'=>'petadote',  'acao'=>'perfil/alterar_geral_pais_estado_cidade',  'pagina'=>false],

'perfil-alterar-geral-nome-email-senha'=>['app'=>'petadote',  'acao'=>'perfil/alterar_geral_nome_email_senha',  'pagina'=>false],
'perfil-email-valida'=>['app'=>'petadote',  'acao'=>'perfil/email_valida',  'pagina'=>false],

'perfil-alterar-gi-telefone-cnpj-endereco'=>['app'=>'petadote',  'acao'=>'perfil/alterar_gi_telefone_cnpj_endereco',  'pagina'=>false],

'perfil-alterar-instituicao-facebook-instagram-youtube'=>['app'=>'petadote',  'acao'=>'perfil/alterar_instituicao_facebook_instagram_youtube',  'pagina'=>false],

'perfil-alterar-instituicao-twitter-googleplus-site'=>['app'=>'petadote',  'acao'=>'perfil/alterar_instituicao_twitter_googleplus_site',  'pagina'=>false],

'perfil-alterar-instituicao-historia'=>['app'=>'petadote',  'acao'=>'perfil/alterar_instituicao_historia',  'pagina'=>false],

'perfil-alterar-instituicao-como-receber-ajuda'=>['app'=>'petadote',  'acao'=>'perfil/alterar_instituicao_como_receber_ajuda',  'pagina'=>false],

'perfil-alterar-instituicao-processo-adocao'=>['app'=>'petadote',  'acao'=>'perfil/alterar_instituicao_processo_adocao',  'pagina'=>false],

'perfil-alterar-instituicao-conteudo-educativo'=>['app'=>'petadote',  'acao'=>'perfil/alterar_instituicao_conteudo_educativo',  'pagina'=>false],

//======CADASTRO========\\
'cadastro'=>['app'=>'petadote',  'acao'=>false,  'pagina'=>'cadastro'],
'cadastrando-pessoa'=>['app'=>'petadote',  'acao'=>'cadastro/cadastrando_pessoa',  'pagina'=>'cadastrando-pessoa'],
'cadastrando-instituicao'=>['app'=>'petadote',  'acao'=>'cadastro/cadastrando_instituicao',  'pagina'=>'cadastrando-instituicao'],
'cadastrar-pessoa'=>['app'=>'petadote',  'acao'=>'cadastro/cadastrar_pessoa',  'pagina'=>'home'],
'cadastrar-instituicao'=>['app'=>'petadote',  'acao'=>'cadastro/cadastrar_instituicao',  'pagina'=>'perfil'],

'ajax_popular_cidade'=>['app'=>'petadote',  'acao'=>'ajax/popular_cidade',  'pagina'=>false],
'ajax_popular_estado'=>['app'=>'petadote',  'acao'=>'ajax/popular_estado',  'pagina'=>false],
'ajax_popular_pais'=>['app'=>'petadote',  'acao'=>'ajax/popular_pais',  'pagina'=>false],
'ajax_email_valida'=>['app'=>'petadote',  'acao'=>'ajax/email_valida',  'pagina'=>false],
'ajax_cnpj_valida'=>['app'=>'petadote',  'acao'=>'ajax/cnpj_valida',  'pagina'=>false],

//====================ACESSIBILIDADE====================\\
'acessibilidade'=>['app'=> 'petadote',  'acao'=>false,  'pagina'=>'acessibilidade'],
'acessibilidade-cor-1'=>['app'=>'petadote', 'acao'=>'acessibilidade/cor_1', 'pagina'=>'acessibilidade'],
'acessibilidade-cor-2'=>['app'=>'petadote', 'acao'=>'acessibilidade/cor_2', 'pagina'=>'acessibilidade'],
'acessibilidade-cor-3'=>['app'=>'petadote', 'acao'=>'acessibilidade/cor_3', 'pagina'=>'acessibilidade'],
'acessibilidade-cor-4'=>['app'=>'petadote', 'acao'=>'acessibilidade/cor_4', 'pagina'=>'acessibilidade'],
'acessibilidade-cor-5'=>['app'=>'petadote', 'acao'=>'acessibilidade/cor_5', 'pagina'=>'acessibilidade'],
'acessibilidade-cor-6'=>['app'=>'petadote', 'acao'=>'acessibilidade/cor_6', 'pagina'=>'acessibilidade'],
'acessibilidade-cor-7'=>['app'=>'petadote', 'acao'=>'acessibilidade/cor_7', 'pagina'=>'acessibilidade'],
'acessibilidade-cor-8'=>['app'=>'petadote', 'acao'=>'acessibilidade/cor_8', 'pagina'=>'acessibilidade'],
'acessibilidade-cor-9'=>['app'=>'petadote', 'acao'=>'acessibilidade/cor_9', 'pagina'=>'acessibilidade'],

'acessibilidade-icon-colorido'=>['app'=>'petadote', 'acao'=>'acessibilidade/icon_colorido', 'pagina'=>'acessibilidade'],
'acessibilidade-icon-vazado'=>['app'=>'petadote', 'acao'=>'acessibilidade/icon_vazado', 'pagina'=>'acessibilidade'],
'acessibilidade-icon-claro'=>['app'=>'petadote', 'acao'=>'acessibilidade/icon_claro', 'pagina'=>'acessibilidade'],
'acessibilidade-icon-escuro'=>['app'=>'petadote', 'acao'=>'acessibilidade/icon_escuro', 'pagina'=>'acessibilidade'],

'acessibilidade-corpo-muito-claro'=>['app'=>'petadote', 'acao'=>'acessibilidade/corpo_muito_claro', 'pagina'=>'acessibilidade'],
'acessibilidade-corpo-claro'=>['app'=>'petadote', 'acao'=>'acessibilidade/corpo_claro', 'pagina'=>'acessibilidade'],
'acessibilidade-corpo-medio'=>['app'=>'petadote', 'acao'=>'acessibilidade/corpo_medio', 'pagina'=>'acessibilidade'],
'acessibilidade-corpo-escuro'=>['app'=>'petadote', 'acao'=>'acessibilidade/corpo_escuro', 'pagina'=>'acessibilidade'],
'acessibilidade-corpo-muito-escuro'=>['app'=>'petadote', 'acao'=>'acessibilidade/corpo_muito_escuro', 'pagina'=>'acessibilidade'],
'acessibilidade-corpo-transparente-claro'=>['app'=>'petadote', 'acao'=>'acessibilidade/corpo_transparente_claro', 'pagina'=>'acessibilidade'],
'acessibilidade-corpo-transparente-escuro'=>['app'=>'petadote', 'acao'=>'acessibilidade/corpo_transparente_escuro', 'pagina'=>'acessibilidade'],

'acessibilidade-menu-esquerda'=>['app'=>'petadote', 'acao'=>'acessibilidade/menu_esquerda', 'pagina'=>'acessibilidade'],
'acessibilidade-menu-direita'=>['app'=>'petadote',
'acao'=>'acessibilidade/menu_direita', 'pagina'=>'acessibilidade'],

'acessibilidade-fontsize-medio'=>['app'=>'petadote', 'acao'=>'acessibilidade/fontsize_medio', 'pagina'=>'acessibilidade'],
'acessibilidade-fontsize-pequeno'=>['app'=>'petadote', 'acao'=>'acessibilidade/fontsize_pequeno', 'pagina'=>'acessibilidade'],
'acessibilidade-fontsize-grande'=>['app'=>'petadote', 'acao'=>'acessibilidade/fontsize_grande', 'pagina'=>'acessibilidade'],


]);
