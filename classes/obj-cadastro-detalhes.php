<?php
class ObjCadastroDetalhes
{
	//Propriedades.
	//----------------------
	public $id = "";
	public $nome = "";
	public $cpfCnpj = "";
	public $dataNascimento = "";
	public $dataNascimentoEditar = "";
	public $endereco = "";
	public $descricaoTitulo = "";
	public $valor = "";
	public $dataVencimento = "";
	public $dataVencimentoEditar = "";
	
	public $resultadoCadastroDetalhes = NULL;
	//----------------------
	
	
	
	//Construtor.
	//**************************************************************************************
	public function __construct($id)
	{
		$this->id = $id;
	}
	//**************************************************************************************
	
	
	//Função para buscar detalhes.
	//**************************************************************************************
    public function cadastroDetalhesLer()
    {
		$this->resultadoCadastroDetalhes = FuncoesEstaticas::tabelaPesquisar("tb_cadastro", 
																			array("id;" . $this->id . ";i"), 
																			"", 
																			"");
																			
		$this->nome = $this->resultadoCadastroDetalhes[0]['nome'];
		$this->cpfCnpj = FuncoesEstaticas::formatarValorGenericoLer($this->resultadoCadastroDetalhes[0]['cpf_cnpj']);
		$this->dataNascimento = FuncoesEstaticas::dataLeitura($this->resultadoCadastroDetalhes[0]['data_nascimento'],1,1);
		$this->dataNascimentoEditar = $this->resultadoCadastroDetalhes[0]['data_nascimento'];
		$this->endereco = $this->resultadoCadastroDetalhes[0]['endereco'];
		$this->descricaoTitulo = $this->resultadoCadastroDetalhes[0]['descricao_titulo'];
		$this->valor = FuncoesEstaticas::mascaraValorLer($this->resultadoCadastroDetalhes[0]['valor']);
		$this->dataVencimento = FuncoesEstaticas::dataLeitura($this->resultadoCadastroDetalhes[0]['data_vencimento'],1,1);
		$this->dataVencimentoEditar = $this->resultadoCadastroDetalhes[0]['data_vencimento'];
	}
	//**************************************************************************************
}
?>