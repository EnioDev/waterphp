<?php namespace model;

use core\base\Model;

class User extends Model
{
    // Você DEVE definir no construtor da classe a tabela
    // que deseja vincular ao modelo e o campo chave
    // primária correspondente se houver.
    public function __construct()
    {
        // Esta é a forma mais simples:
        parent::__construct('users', 'id');

        // Você também pode utilizar os métodos se preferir:
        #$this->setTable('users');
        #$this->setPrimaryKey('id');
    }

    // Você pode mapear o nome dos campos da tabela usando
    // constantes e acessá-los posteriormente em qualquer
    // controlador que utilize este modelo.
    // Desta forma, se alterar o nome de algum campo na
    // tabela, basta alterar o valor na constante uma única
    // vez e os controladores estarão atualizados.
    // Isto é somente uma boa prática, mas não é obrigatório.
    const COLUMN_NAME   = 'name';
    const COLUMN_EMAIL  = 'email';
    const COLUMN_PASSWD = 'password';
}