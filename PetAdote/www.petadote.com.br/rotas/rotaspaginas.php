<?php
URL::rotaspaginas([

//=====home============\\
'home'=>['pagina'=>'home',
'css'=>[],
'js'=>[]],

//======pets=======\\
'pets'=>['pagina'=>'pets',
'css'=>['formulario', 'pets/pets', 'pets/show_pet', 'option-box'],
'js'=>['popular_pais_estado_cidade_pesquisa', 'pets/pets', 'pets/pesquisapet']],

//======perdidos=======\\
'perdidos'=>['pagina'=>'perdidos',
'css'=>['formulario', 'pets/pets', 'pets/show_pet', 'option-box'],
'js'=>['popular_pais_estado_cidade_pesquisa', 'perdidos/pets_perdido', 'pets/pesquisapet']],

//======encontrados=======\\
'encontrados'=>['pagina'=>'encontrados',
'css'=>['formulario', 'pets/pets', 'pets/show_pet', 'option-box'],
'js'=>['popular_pais_estado_cidade_pesquisa', 'encontrados/pets_encontrado', 'pets/pesquisapet']],

//======NOTICIAS=======\\
'noticias'=>['pagina'=>'noticias/noticias',
'css'=>['noticias/formulario', 'noticias/noticias_componentes', 'noticias/noticias'],
'js'=>['popular_pais_estado_cidade_pesquisa', 'noticias/noticias', 'noticias/mostrar']],

'cadastrando-noticia'=>['pagina'=>'noticias/cadastrando_noticia',
'css'=>['noticias/formulario_cadastrando', 'noticias/cadastrando_noticia', 'noticias/noticias'],
'js'=>['noticias/mostrar']],

//======INSTITUICOES=======\\
'instituicoes'=>['pagina'=>'instituicoes/instituicoes',
'css'=>['instituicoes/formulario', 'instituicoes/instituicoes'],
'js'=>['popular_pais_estado_cidade_pesquisa', 'pets/pesquisapet', 'cnpj']],

'instituicao'=>['pagina'=>'instituicoes/instituicao',
'css'=>['instituicoes/instituicao', 'instituicoes/show_parceiro'],
'js'=>['instituicoes/parceiros']],

//======PARCEIROS=======\\
'parceiros'=>['pagina'=>'parceiros/parceiros',
'css'=>['parceiros/parceiros', 'parceiros/show_parceiro', 'option-box'],
'js'=>['parceiros/parceiros']],

'cadastrando-parceiro'=>['pagina'=>'parceiros/cadastrando_parceiro',
'css'=>['formulario', 'cadastrando_seletor_imagem'],
'js'=>['seletor_area_imagem', 'cnpj', 'telefone']],

//=========ENTRAR==================\\
'entrar'=>['pagina'=>'entrar/entrar',
'css'=>['formulario', 'entrar/entrar'],
'js'=>['entrar/entar_logar']],

'recuperando-senha'=>['pagina'=>'entrar/recuperar_senha',
'css'=>['formulario', 'entrar/entrar'],
'js'=>[]],

'recuperando-senha-email-enviado'=>['pagina'=>'entrar/recuperando_senha_email_enviado',
'css'=>[],
'js'=>[]],

'alterando-senha'=>['pagina'=>'entrar/alterando_senha',
'css'=>['formulario', 'entrar/entrar'],
'js'=>[]],

//======CADASTRO=======\\
'cadastro'=>['pagina'=>'cadastro/cadastro',
'css'=>['cadastro/cadastro'],
'js'=>[]],

'cadastrando-pessoa'=>['pagina'=>'cadastro/cadastrando_pessoa',
'css'=>['formulario', 'cadastro/cadastrando_pessoa', 'cadastrando_seletor_imagem'],
'js'=>[ 'seletor_area_imagem', 'popular_pais_estado_cidade', 'cadastro/validar_pessoa', 'telefone']],

'cadastrando-instituicao'=>['pagina'=>'cadastro/cadastrando_instituicao',
'css'=>['formulario', 'cadastro/cadastrando_instituicao', 'cadastrando_seletor_imagem'],
'js'=>[ 'seletor_area_imagem', 'cnpj', 'popular_pais_estado_cidade', 'cadastro/validar_instituicao', 'telefone']],

//======MEUS=PESTS=======\\
'meuspets'=>['pagina'=>'meuspets/meuspets',
'css'=>['meuspets/meus_pets', 'meuspets/show_pet_meu', 'formulario', 'option-box'],
'js'=>['meuspets/pets', 'meuspets/pesquisapet']],

'cadastrando-pet'=>['pagina'=>'meuspets/cadastrando_pet',
'css'=>['formulario', 'meuspets/cadastrando_pet', 'cadastrando_seletor_imagem'],
'js'=>['meuspets/seletor_area_imagem_1', 'meuspets/seletor_area_imagem_2' , 'meuspets/seletor_area_imagem_3']],


//======vinculos=======\\
'vinculos'=>['pagina'=>'vinculos',
'css'=>['vinculos/pets', 'vinculos/show_pet', 'option-box'],
'js'=>['vinculos/pets']],

//======interessados=======\\
'interessados'=>['pagina'=>'interessados',
'css'=>['interessados/pets', 'interessados/show_pet', 'option-box'],
'js'=>['interessados/pets']],

//======perfil=======\\
'perfil'=>['pagina'=>'perfil',
'css'=>['perfil/perfil', 'cadastrando_seletor_imagem'],
'js'=>['popular_pais_estado_cidade', 'cnpj', 'telefone', 'seletor_area_imagem', 'perfil/perfil']],

//======acessibilidade=======\\
'acessibilidade'=>['pagina'=>'acessibilidade',
'css'=>['acessibilidade/acessibilidade'],
'js'=>[]],

//======ajuda=======\\
'ajuda'=>['pagina'=>'ajuda',
'css'=>['formulario', 'ajuda/ajuda'],
'js'=>[]],



]);
