function searchMatch(rowContent: string, searchValue: string) {
    return rowContent.toLowerCase().indexOf(searchValue.toLowerCase()) > -1;
}

function getSearchItems(): HTMLElement[] | null {
    const searchTable = document.getElementById('search-table');
    if (searchTable) {
        const searchBody = searchTable.getElementsByTagName('tbody')[0];
        return [...searchBody.getElementsByTagName('tr')];
    }

    const searchRow = document.getElementById('search-row');
    if (searchRow) {
        return [...searchRow.getElementsByClassName('search-item')]
                        .map((item) => item as HTMLElement);
    }

    return null;
}
export function BindSearchBar() {
    const searchBar = document.getElementById('search-bar') as HTMLInputElement;
    const searchItems = getSearchItems();
    if (searchBar && searchItems) {
        searchBar.addEventListener('keyup', () => {
            const searchValue = searchBar.value;
            for (let i = 0; i < searchItems.length; i++) {
                const itemContent = searchItems[i].innerText;
                const shouldHide = !searchMatch(itemContent, searchValue);
                if (shouldHide) {
                    searchItems[i].style.display = 'none';
                } else {
                    searchItems[i].style.display = '';
                }
            }
        });
    }
}