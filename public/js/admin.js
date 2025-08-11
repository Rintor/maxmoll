document.addEventListener("DOMContentLoaded", function() {
    let nameInput = document.querySelector(".form-product input[name='name'], .form-category input[name='name']");
    let slugInput = document.querySelector(".form-product input[name='slug'], .form-category input[name='slug']");

    function translit(str) {
        const map = {
            'а': 'a', 'б': 'b', 'в': 'v', 'г': 'g', 'д': 'd',
            'е': 'e', 'ё': 'yo', 'ж': 'zh', 'з': 'z', 'и': 'i',
            'й': 'y', 'к': 'k', 'л': 'l', 'м': 'm', 'н': 'n',
            'о': 'o', 'п': 'p', 'р': 'r', 'с': 's', 'т': 't',
            'у': 'u', 'ф': 'f', 'х': 'h', 'ц': 'ts', 'ч': 'ch',
            'ш': 'sh', 'щ': 'sch', 'ъ': '', 'ы': 'y', 'ь': '',
            'э': 'e', 'ю': 'yu', 'я': 'ya'
        };
        return str
            .toLowerCase()
            .split('')
            .map(char => map[char] !== undefined ? map[char] : char)
            .join('');
    }

    function generateSlug(value) {
        return translit(value)
            .replace(/\s+/g, '-')
            .replace(/[^a-z0-9\-]/g, '')
            .replace(/\-+/g, '-')
            .replace(/^-+|-+$/g, '');
    }

    if (nameInput && slugInput) {
        if (!slugInput.value.trim()) {
            nameInput.addEventListener("input", function() {
                slugInput.value = generateSlug(nameInput.value);
            });
        }
    }
});
