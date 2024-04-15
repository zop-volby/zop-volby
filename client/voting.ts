import * as bootstrap from "bootstrap";
import Toastify from "toastify-js";

function GetVotingRecap(data: { Name: string | null, MaxVotes: number, Votes: number }) {
    if (data.Votes === 0) {
        return "<span class='text-danger fw-bold'>" + data.Name + "</span>: neodevzdaný žádný hlas.";
    }
    if (data.Votes === data.MaxVotes) {
        return "<span class='text-success fw-bold'>" + data.Name + "</span>: vyplněný celý lístek.";
    }
    return "<span class='text-warning fw-bold'>" + data.Name + "</span>: " + data.Votes + " z " + data.MaxVotes + " možných hlasů.";
}
export function BindVotingView() {
    const sendButton = document.getElementById("send-button") as HTMLButtonElement;
    sendButton.addEventListener("click", () => {
        const lists = document.getElementsByClassName("voting-list");
        const data = [];
        let fullVote = true;
        for (let list of lists) {
            const listName = list.getElementsByClassName("list-name")[0].textContent;
            const listId = (list as HTMLElement).dataset.list;
            const listField = document.getElementById(`list_${listId}`) as HTMLInputElement;
            const votes = listField.value ? listField.value.split(",") : [];
            const maxVotes = parseInt((list as HTMLElement).dataset.maxvotes || "");
            data.push({ 
                Name: listName,
                MaxVotes: maxVotes,
                Votes: votes.length,
            });
            fullVote = fullVote && votes.length === maxVotes;
        }
        const confirmPopup = new bootstrap.Modal("#confirm-voting", {});
        const confirmText = document.getElementById("voting-recap") as HTMLElement;        
        confirmText.innerHTML = data.map(d => GetVotingRecap(d)).map(d => "<p>" + d + "</p>").join("");
        confirmPopup.show();
        const warningText = document.getElementById("voting-warning") as HTMLElement;
        warningText.style.display = fullVote ? "none" : "block";
        warningText.innerHTML = "Odevzdáváte neúplný hlasovací lístek. Opravdu chcete pokračovat?";
        const confirmButton = document.getElementById("confirm-button") as HTMLButtonElement;
        confirmButton.innerText = fullVote ? "Odeslat" : "Přesto odeslat";
    });
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
                    if (values.length >= maxVotes) {
                        Toastify({
                            text: 'Hlasování je omezeno na maximální počet ' + maxVotes + ' hlasů.',
                            gravity: "bottom",
                            position: "center",
                        }).showToast();
                    }
                    else {
                        values.push(nomineeId);
                        check.classList.remove("bi-square");
                        check.classList.add("bi-check-square");
                    }
                } else {
                    values.splice(index, 1);
                    check.classList.remove("bi-check-square");
                    check.classList.add("bi-square");
                }
                listField.value = values.join(",");
                votesSpan.innerText = values.length.toString();

                votesBadge.classList.remove("bg-success", "bg-primary", "bg-warning");
                if (values.length === 0) {
                    votesBadge.classList.add("bg-primary");
                } 
                else if (values.length < maxVotes) {
                    votesBadge.classList.add("bg-warning");
                } 
                else {
                    votesBadge.classList.add("bg-success");
                }
            });
        }
    };
}