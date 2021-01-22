# Instruções para inicialização do projeto
* Clonar este repositório;
* Abrir o terminal dentro do diretório onde está o projeto;
* Rodar o comando ````docker-compose up -d````;
* Esperar alguns segundos para que todo o projeto seja instalado e configurado;
* Após a finalização do build o projeto estará rodando em ````http://localhost:8000````

## Modelagem do banco do projeto


<p align="center">
  <img src="https://user-images.githubusercontent.com/52502727/99321441-352d9900-2844-11eb-95b0-08987a8d6a0a.PNG" width="350" title="hover text">
</p>

## Endpoints


 ````POST api/customers````

 Para criar um cliente, o corpo da requisição deverá ser como:

 ````
 {
	"name": "Arthur",
	"email": "teste@gmail.com",
	"document": "01112085130"
}
 ````

 Exemplo de resposta:

  ````
 {
    "id": 1,
    "name": "Arthur",
    "email": "teste@gmail.com",
    "document": "01112085130",
    "created_at": "2020-11-14 21:03:27",
    "updated_at": "2020-11-14 21:37:09"
}
 ````

 ````POST api/products````

 Para criar um produto, o corpo da requisição deverá ser como:
 
 NOTA: O 'type' = 1 refere-se ao tipo de produto digital e o 'type' = 0 ao produto físico

 ````
 {
	"type": 1,
	"name": "e-book",
	"description": "Livro Clean Code",
	"value": 10.0,
    "link": "exemplo.com.br/produto"
}
 ````

 Exemplo de resposta:

  ````
 {
	"type": 1,
	"name": "e-book",
	"description": "Livro Clean Code",
	"value": 10.0,
    "link": "exemplo.com.br/produto"
}
 ````
 
 ````GET api/products````

 Para listagem de produtos cadastrados:

 Exemplo de resposta:

  ````
 [
    {
        "id": 1,
        "name": "Teclado",
        "description": "Teclado redragon",
        "type": 0,
        "value": 100,
        "link": null,
        "created_at": "2020-11-15 21:03:27",
        "updated_at": "2020-11-15 21:37:09"
    },
    {
        "id": 2,
        "name": "mouse",
        "description": "Mouse logitech",
        "type": 0,
        "value": 10,
        "link": null,
        "created_at": "2020-11-15 21:04:46",
        "updated_at": "2020-11-15 21:04:46"
    }
]
 ````

 ````PUT api/products/{id}````

 Para editar um produto existente,  o corpo da requisição deverá ser como:

 ````
{
	"type": 0,
	"name": "Teclado",
	"description": "Teclado redragon",
	"value": 100.0
}
 ````

 Exemplo de resposta:

  ````
{
    "id": 1
	"type": 0,
	"name": "Teclado",
	"description": "Teclado redragon",
	"value": 100.0,
    "created_at": "2020-11-15 21:04:46",
    "updated_at": "2020-11-15 22:00:23"
}
 ````

  ````GET api/warehouses````

 Para listagem de produtos em estoque:

 Exemplo de resposta:

  ````
 [
    {
        "id": 1,
        "product_id": 2,
        "product_name": "mouse",
        "quantity": 6,
        "created_at": "2020-11-15 21:04:47",
        "updated_at": "2020-11-15 21:04:47"
    },
    {
        "id": 2,
        "product_id": 3,
        "product_name": "teclado",
        "quantity": 10,
        "created_at": "2020-11-15 21:51:58",
        "updated_at": "2020-11-15 21:51:58"
    }
]
 ````

 ````POST api/purchases````

 Para criar uma compra, o corpo da requisição deverá ser como:
 

 ````
 {
	"products": [
		{
			"product_id": 2,
			"quantity": 3
		},
		{
			"product_id": 3,
			"quantity": 10
		}
	]
}
 ````

 
 ````GET api/purchases````

 Para listagem de compras cadastradas:

NOTA: Os números a frente do array são equivalentes aos ids das compras e os itens em seu interior são so produtos comprados.

 Exemplo de resposta:

  ````
 {
  "28": [
    {
      "id": 4,
      "product_id": 2,
      "purchase_id": 28,
      "quantity": 3,
      "created_at": null,
      "updated_at": null
    }
  ],
  "29": [
    {
      "id": 5,
      "product_id": 2,
      "purchase_id": 29,
      "quantity": 3,
      "created_at": null,
      "updated_at": null
    },
    {
      "id": 6,
      "product_id": 3,
      "purchase_id": 29,
      "quantity": 10,
      "created_at": null,
      "updated_at": null
    }
  ]
}
 ````

### NOTA: Os endpoints abaixo não estão funcionando, peço para que se possível analisar o código para os mesmos.



  ````POST api/sales````

Para criar uma venda, o corpo da requisição deverá ser como:
 

 ````
{
	"customer_id": 1,
	"products": [
		{
			"product_id": 2,
			"quantity": 3
		},
		{
			"product_id": 3,
			"quantity": 10
		}
	]
}
 ````

  ````GET api/sales````
 

Made with 💜 by [Arthur Ramires](https://github.com/arthurramires) 🚀
