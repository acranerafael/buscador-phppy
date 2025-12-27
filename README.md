# PyPHP: Hybrid Search Engine Boilerplate

Este repositório serve como um **boilerplate** para a integração de **PHP** (Hypertext Preprocessor) com **Python** em um ambiente web, demonstrando uma arquitetura híbrida onde o PHP atua como frontend/controller e o Python como backend de processamento de dados intensivo.

## 🚀 Metodologia e Arquitetura

A solução utiliza uma abordagem de **acoplamento fraco** baseada na execução de subprocessos do sistema operacional.

### 1. Integração PHP + Python (IPC via CLI)
A comunicação entre as duas linguagens é realizada através da interface de linha de comando (CLI).

- **PHP (Controller):** Responsável por receber a requisição HTTP (GET), sanitizar os inputs e invocar o script Python.
- **Python (Core Logic):** Atua como o motor de busca. Recebe os parâmetros via argumentos de linha de comando (`sys.argv`), processa a leitura do arquivo de dados (`data.txt`) e utiliza Expressões Regulares (`re` module) para busca e *highlighting* de termos.
- **Data Exchange:** O PHP utiliza a função nativa `shell_exec()` para disparar o interpretador Python. A saída padrão (`stdout`) do Python é capturada pelo PHP e renderizada diretamente no DOM.

**Fluxo de Execução:**
1. **User Request:** O usuário envia o termo de busca via formulário HTML.
2. **Sanitization:** O PHP sanitiza o input utilizando `escapeshellarg` para prevenir injeção de comandos.
3. **Subprocess Invocation:** O PHP executa o comando `python search_engine.py <term>`.
4. **Processing:** O Python carrega o dataset em memória, executa a lógica de *pattern matching* (case-insensitive) e aplica marcadores HTML (tags `<span>`) nos resultados.
5. **Output:** O Python imprime o HTML processado na saída padrão (`stdout`).
6. **Rendering:** O PHP captura o buffer de saída e o injeta na resposta HTTP.

### 2. Estilização e Frontend (CSS3)
A interface é construída com HTML5 semântico e CSS3, focando em usabilidade e legibilidade.

- **CSS Strategy:** Utiliza-se um arquivo de estilos externo (`css/style.css`) para separação de responsabilidades (SoC).
- **Highlighting Visual:** A classe `.highlight` é injetada dinamicamente pelo Python nos termos encontrados, permitindo controle total da apresentação via CSS (ex: cor de fundo, peso da fonte).
- **Layout:** Estrutura fluida e limpa, priorizando a leitura do conteúdo textual.

## 📂 Estrutura de Arquivos

- `index.php`: Ponto de entrada (Entrypoint). Gerencia a view e a orquestração do subprocesso Python.
- `search_engine.py`: Script Python que encapsula a lógica de "Business Intelligence" da busca.
- `data.txt`: Base de dados textual (flat file) utilizada para as consultas.
- `css/style.css`: Folhas de estilo para definição da identidade visual.
- `setup_data.py`: Script utilitário para geração ou reset do arquivo de dados.

## 🛠️ Requisitos Técnicos

- **PHP 7.4+**
- **Python 3.x**
- Servidor Web (Apache, Nginx, IIS ou PHP Built-in Server).
- Permissões de execução: O usuário do processo do servidor web deve ter permissão para invocar o binário `python` no sistema operacional.

## 📦 Instalação e Execução

1. Clone o repositório.
2. Certifique-se de que o executável do Python está acessível via variável de ambiente `PATH`.
3. Configure o servidor web para servir o diretório do projeto.
4. Popule o arquivo `data.txt` com o conteúdo a ser indexado.
5. Acesse `index.php` no navegador.

---
*Este projeto é um exemplo de interoperabilidade entre linguagens de script no backend, ideal para cenários onde se deseja aproveitar bibliotecas específicas do ecossistema Python dentro de uma aplicação PHP legada ou consolidada.*
