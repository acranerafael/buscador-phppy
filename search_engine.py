import sys
import re
import os

# Garante que a saída no Windows seja UTF-8 para não quebrar acentos
sys.stdout.reconfigure(encoding='utf-8')

def main():
    # Pega o termo de busca dos argumentos (ou vazio se não houver)
    query = sys.argv[1] if len(sys.argv) > 1 else ""
    data_file = 'data.txt'

    if not os.path.exists(data_file):
        print("Erro: data.txt não encontrado.")
        return

    try:
        with open(data_file, 'r', encoding='utf-8') as f:
            for line in f:
                line = line.strip()
                if not line:
                    continue
                
                # Se houver busca, aplica o destaque
                if query:
                    # Escapa caracteres especiais do regex (como ., *, ?)
                    escaped_query = re.escape(query)
                    
                    # Regex: (?i) ignora maiúsculas/minúsculas
                    # \1 substitui pelo próprio grupo encontrado (mantém se estava maiúsculo ou minúsculo)
                    line = re.sub(f'(?i)({escaped_query})', r'<span class="highlight">\1</span>', line)
                
                # Imprime formatado como parágrafo HTML
                print(f"<p>{line}</p>")

    except Exception as e:
        print(f"Erro ao processar: {e}")

if __name__ == "__main__":
    main()
