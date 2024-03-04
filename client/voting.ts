export function BindVotingView() {
    for (let list of document.getElementsByClassName("voting-list")) {
        const listId = (list as HTMLElement).dataset.list;
        const votesBadge = document.getElementById(`badge_${listId}`) as HTMLElement;
        const votesSpan = document.getElementById(`votes_${listId}`) as HTMLElement;
        const maxVotes = parseInt((list as HTMLElement).dataset.maxvotes || "");
        const listField = document.getElementById(`list_${listId}`) as HTMLInputElement;
        const nominees = list.getElementsByClassName("voting-nominee");
        for (let nominee of nominees) {
            const nomineeId = (nominee as HTMLElement).dataset.nominee;
            if (!nomineeId) continue;
            const button = nominee.getElementsByClassName("voting-button")[0] as HTMLElement;
            button.addEventListener("click", () => {
                const values = listField.value ? listField.value.split(",") : [];
                const index = values.indexOf(nomineeId);
                const check = document.getElementById(`check_${listId}_${nomineeId}`) as HTMLElement;
                if (index === -1) {
                    if (values.length >= maxVotes) return;
                    values.push(nomineeId);
                    check.classList.remove("bi-square");
                    check.classList.add("bi-check-square");
                } else {
                    values.splice(index, 1);
                    check.classList.remove("bi-check-square");
                    check.classList.add("bi-square");
                }
                listField.value = values.join(",");
                votesSpan.innerText = values.length.toString();

                if (values.length < maxVotes) {
                    votesBadge.classList.add("bg-primary");
                    votesBadge.classList.remove("bg-success");
                } else {
                    votesBadge.classList.remove("bg-primary");
                    votesBadge.classList.add("bg-success");
                }
            });
        }
    };
}