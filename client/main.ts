import { BindQrCodeScanner } from "./qrcode";
import { BindSearchBar } from "./searchbar";
import { BindVotingView } from "./voting";

export function Main() {
    BindSearchBar();

    if (document.getElementById('secret_token')) {
        BindVotingView();
    }

    if (document.getElementById('qrcode_scanner')) {
        BindQrCodeScanner();
    }
}