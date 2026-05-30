# 🧮 Calculator Tools

> Ferramenta de cálculos online com interface web e API REST — construída com Laravel 13 e MySQL.

![Demo GIF](docs/demo.gif)

## 📋 Sobre o projeto

O **Calculator Tools** é uma ferramenta de cálculos online que oferece dois modos de uso: uma interface web via Blade para uso direto no navegador e endpoints REST em JSON para integração com outros sistemas — sem necessidade de autenticação em ambos os casos.

O projeto foi desenvolvido como portfólio para demonstrar conhecimentos em arquitetura MVC com Laravel, separação de responsabilidades com Services, reutilização de lógica entre controllers e registro de métricas no banco de dados.

## ✨ Funcionalidades

### Matemática
| Calculadora | Descrição |
|---|---|
| **Porcentagem** | Calcula quanto um valor representa em porcentagem de outro |
| **Regra de Três Simples** | Resolve proporções do tipo C → B / A → X |
| **Resto da Divisão** | Retorna o resto de uma divisão com suporte a decimais |

### Áreas Geométricas
| Calculadora | Fórmula |
|---|---|
| **Círculo** | π × r² |
| **Quadrado** | lado² |
| **Retângulo** | base × altura |
| **Triângulo** | (base × altura) / 2 |

### Datas
| Calculadora | Descrição |
|---|---|
| **Dias entre Datas** | Conta o total de dias entre duas datas |

## 🛠️ Tecnologias utilizadas

- **PHP 8.5** + **Laravel 13**
- **MySQL** — armazena contagem de cálculos realizados
- **Blade** — template engine nativa do Laravel
- **CSS puro** — sem frameworks externos
- **Eloquent ORM** — mapeamento objeto-relacional

## 🏗️ Arquitetura

```
app/
├── Http/
│   └── Controllers/
│       ├── CalculadoraController.php        # Controller web (Blade)
│       └── Api/
│           └── CalculadoraApiController.php # Controller API (JSON)
├── Models/
│   └── Calculo.php                          # Model para registro de métricas
└── Services/
    └── CalculadoraService.php               # Lógica e regras de validação

database/
└── migrations/
    └── create_calculos_table.php            # Tabela com enum de tipos

resources/views/
├── layouts/
│   └── app.blade.php                        # Layout base
├── calculadoras/
│   ├── _errors.blade.php                    # Partial de erros reutilizável
│   ├── porcentagem.blade.php
│   ├── regra_tres_simples.blade.php
│   ├── resto_da_divisao.blade.php
│   ├── area_circulo.blade.php
│   ├── area_quadrado.blade.php
│   ├── area_retangulo.blade.php
│   ├── area_triangulo.blade.php
│   └── dias_entre_datas.blade.php
└── home.blade.php

routes/
├── web.php                                  # Rotas da interface Blade
└── api.php                                  # Rotas da API REST
```

**Fluxo de uma requisição web:**
```
GET /calculadoras/{tipo} → CalculadoraController → Blade renderiza view

POST /calculadoras/{tipo} → CalculadoraController → CalculadoraService → Registra no banco → Retorna resultado
```

**Fluxo de uma requisição API:**
```
POST /api/calculadoras/{tipo} → CalculadoraApiController → CalculadoraService → Retorna JSON
```

## 🗄️ Estrutura do banco de dados

```
calculos
├── id
├── tipo (enum: porcentagem, regra_tres_simples, resto_da_divisao,
│          area_circulo, area_quadrado, area_retangulo,
│          area_triangulo, dias_entre_datas)
└── timestamps
```

A tabela `calculos` registra cada operação realizada — permitindo análise de quais calculadoras são mais usadas e em quais dias.

## 🧠 Decisões técnicas

### Por que um CalculadoraService?
A lógica dos cálculos e as regras de validação vivem no Service, permitindo que tanto o controller web (Blade) quanto o controller da API (JSON) a reutilizem sem duplicação de código. Isso segue o princípio DRY (Don't Repeat Yourself).

### Por que sem autenticação?
A ferramenta é pública — qualquer pessoa pode calcular sem criar conta, assim como calculadoras online convencionais. Autenticação adicionaria complexidade desnecessária para esse caso de uso.

### Por que salvar no banco sem histórico por usuário?
O objetivo não é exibir histórico por usuário, mas registrar métricas de uso — quais calculadoras são mais acessadas e em quais dias. Isso permite análise de comportamento sem expor dados de usuários.

### Por que switch em vez de classes separadas?
Para 8 operações simples, a legibilidade do `switch` supera a complexidade de criar uma classe por calculadora. Em um projeto maior, o padrão **Strategy** seria mais adequado — cada operação teria sua própria classe com uma interface comum.

### Por que partial `_errors.blade.php`?
Em vez de repetir o bloco de erros em todas as views, ele foi extraído para um partial reutilizável — uma mudança no estilo dos erros afeta todas as calculadoras de uma vez.

## 🚀 Como rodar localmente

### Pré-requisitos

- PHP 8.3+
- Composer
- MySQL

### Instalação

```bash
# 1. Clone o repositório
git clone https://github.com/felipekauan1/calculator-tools-api.git
cd calculator-tools-api

# 2. Instale as dependências
composer install

# 3. Configure o ambiente
cp .env.example .env
php artisan key:generate

# 4. Configure o banco de dados no .env
DB_DATABASE=calculator_tools_api
DB_USERNAME=root
DB_PASSWORD=sua_senha

# 5. Crie o banco e rode as migrations
php artisan migrate
```

### Rodando o projeto

```bash
php artisan serve
```

Acesse `http://localhost:8000/calculadoras` no navegador.

## 🔀 Rotas Web (Blade)

| Método | URL | Descrição |
|---|---|---|
| `GET` | `/calculadoras` | Lista todas as calculadoras |
| `GET` | `/calculadoras/{tipo}` | Exibe o formulário de uma calculadora |
| `POST` | `/calculadoras/{tipo}` | Processa o cálculo e retorna o resultado |

## 📡 API REST

**Base URL:** `http://localhost:8000/api`

A API é pública e não requer autenticação. Todas as respostas são em JSON.

### Listar calculadoras disponíveis
```
GET /api/calculadoras
```

**Resposta (200):**
```json
{
    "sucesso": true,
    "tipos": [
        "porcentagem",
        "regra_tres_simples",
        "resto_da_divisao",
        "area_circulo",
        "area_quadrado",
        "area_retangulo",
        "area_triangulo",
        "dias_entre_datas"
    ]
}
```

### Realizar um cálculo
```
POST /api/calculadoras/{tipo}
Content-Type: application/json
```

**Parâmetros por tipo:**

**porcentagem**
```json
{ "porcentagem": 5, "valor": 200 }
```

**regra_tres_simples**
```json
{ "a": 10, "b": 50, "c": 3 }
```

**resto_da_divisao**
```json
{ "dividendo": 17, "divisor": 5 }
```

**area_circulo**
```json
{ "raio": 7 }
```

**area_quadrado**
```json
{ "lado": 5 }
```

**area_retangulo**
```json
{ "base": 8, "altura": 5 }
```

**area_triangulo**
```json
{ "base": 6, "altura": 4 }
```

**dias_entre_datas**
```json
{ "data_inicio": "2024-01-01", "data_fim": "2024-12-31" }
```

**Resposta de sucesso (200):**
```json
{
    "sucesso": true,
    "dados": {
        "porcentagem": "5",
        "valor": "200"
    },
    "resultado": 10
}
```

**Erro de validação (422):**
```json
{
    "message": "The porcentagem field is required.",
    "errors": {
        "porcentagem": ["The porcentagem field is required."]
    }
}
```

**Tipo inválido (404):**
```json
{
    "message": "Not Found"
}
```

## 📸 Screenshots

![Demo GIF](docs/resto_da_divisao.gif)

## 📌 Possíveis melhorias futuras

- Histórico de cálculos por sessão do usuário
- Dashboard de métricas com gráfico de uso por calculadora
- Novas calculadoras: IMC, juros compostos, conversão de unidades
- Testes automatizados com PHPUnit
- Padrão Strategy para organizar as operações em classes separadas

## 👨‍💻 Autor

Desenvolvido por **[@felipekauan1](https://github.com/felipekauan1)**

## 📄 Licença

Este projeto está sob a licença MIT.
