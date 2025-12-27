import re
import os

html_file = 'index.html'
if not os.path.exists(html_file):
    print(f"Erro: {html_file} não encontrado.")
    exit(1)

with open(html_file, 'r', encoding='utf-8') as f:
    content = f.read()

# Extrai conteúdo dentro de tags <p>
paragraphs = re.findall(r'<p>(.*?)</p>', content, re.DOTALL)

# Limpa espaços extras e quebras de linha dentro do parágrafo
cleaned_paragraphs = []
for p in paragraphs:
    # Remove tags internas se houver para deixar texto puro
    text = re.sub(r'<[^>]+>', '', p)
    text = ' '.join(text.split())
    if text:
        cleaned_paragraphs.append(text)

with open('data.txt', 'w', encoding='utf-8') as f:
    for p in cleaned_paragraphs:
        f.write(p + '\n')

print(f"Sucesso! 'data.txt' criado com {len(cleaned_paragraphs)} parágrafos.")
