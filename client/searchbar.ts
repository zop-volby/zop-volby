function searchMatch(rowContent: string, searchValue: string) {
    return rowContent.toLowerCase().indexOf(searchValue.toLowerCase()) > -1;
}

export function BindSearchBar() {
    const searchBar = document.getElementById('search-bar') as HTMLInputElement;
    const searchTable = document.getElementById('search-table');
    if (searchTable && searchBar) {
        const searchBody = searchTable.getElementsByTagName('tbody')[0];
        searchBar.addEventListener('keyup', () => {
            const searchValue = searchBar.value;
            const rows = searchBody.getElementsByTagName('tr');
            for (let i = 0; i < rows.length; i++) {
                const rowContent = rows[i].innerText;
                const shouldHide = !searchMatch(rowContent, searchValue);
                if (shouldHide) {
                    rows[i].style.display = 'none';
                } else {
                    rows[i].style.display = '';
                }
            }
        });
    }
}