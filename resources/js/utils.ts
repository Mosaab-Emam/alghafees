export function withColoredText(text: string) {
    return text.replace(
        /(\$\$)(.*?)\1/g,
        '<span class="text-primary-600">$2</span>'
    );
}
