let navbar = document.getElementById('navbar');
let sticky = navbar.offsetTop;
window.onscroll = function () {
    stickyNavbar()
};//Appel de la fonction stickyNavbar lors du scroll de la page
//Fonction qui permet de rendre la navbar sticky avant qu'elle disparaisse lors du scroll.
function stickyNavbar() {
    if (window.pageYOffset >= sticky) {
        navbar.classList.add('sticky');
    } else {
        navbar.classList.remove('sticky');
    }
}

//Permet de changer les couleur des liens vers les réseaux sociauxlors du survol de la souris.
document.getElementById('facebook').addEventListener('mouseover', changeColorFacebook);
function changeColorFacebook() {
    this.style.backgroundColor = '#3B5998';
    document.getElementById('facebookIcon').style.color = 'white';
}
document.getElementById('facebook').addEventListener('mouseout', rechangeColorFacebook);
function rechangeColorFacebook() {
    this.style.backgroundColor = 'grey';
    document.getElementById('facebookIcon').style.color = 'black';
}
document.getElementById('instagram').addEventListener('mouseover', changeColorInstagram);
function changeColorInstagram() {
    this.style.background = 'linear-gradient(218deg, rgba(131,58,180,1) 0%, rgba(253,29,29,1) 50%, rgba(252,176,69,1) 100%)';
    document.getElementById('instagramIcon').style.color = 'white';
}
document.getElementById('instagram').addEventListener('mouseout', rechangeColorInstagram);
function rechangeColorInstagram() {
    this.style.background = 'grey';
    document.getElementById('instagramIcon').style.color = 'black';
}
document.getElementById('twitter').addEventListener('mouseover', changeColorTwitter);
function changeColorTwitter() {
    this.style.backgroundColor = '#1DA1F2';
    document.getElementById('twitterIcon').style.color = 'white';
}
document.getElementById('twitter').addEventListener('mouseout', rechangeColorTwitter);
function rechangeColorTwitter() {
    this.style.backgroundColor = 'grey';
    document.getElementById('twitterIcon').style.color = 'black';
}

//Permet d'afficher ou de cacher l'input choisit lors de la création d'un article.
if (document.getElementById('articleByTextOrVideo') != null) {
    document.getElementById('articleByTextOrVideo').addEventListener('change', function () {
        let styleText = this.value == 'text' ? 'block' : 'none';
        document.getElementById('byText').style.display = styleText;
        let styleVideo = this.value == 'video' ? 'block' : 'none';
        document.getElementById('byVideo').style.display = styleVideo;
    });
}

/*Transfert de l'id d'un article d'un bouton vers l'input d'une modal.
 * getElementsByClassName retourne une liste d'éléments, il faut donc parcourir la liste pour ajouter les listener.
 */
let list = document.getElementsByClassName('deleteModalButton'), li = list.length, i;
for (i = 0; i < li; i++) {
    list[i].addEventListener("click", function () {
        idArticle = this.getAttribute('data-id');
        document.getElementById('articleId').value = idArticle;
    });
}