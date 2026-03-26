</div>
<footer>
    <div class="social">
        <a href="https://www.instagram.com/"><img src="img\instaJjaune.png" height="70px" width="70px"/></a>
        <a href="https://www.tiktok.com/"><img src="img\tiktokJaune.png" height="70px" width="70px"/></a>
    </div>
    <div class="nav-footer">
        <ul>
            <li><a href="/cgv">CGV/CGU</a></li>
            <li><a href="/mentions-legales">Mentions légales</a></li>
            <li><a href="/contact">Contact</a></li>
        </ul>   
    </div>
    <div>
        <img src="../img/LogoTripHorizonClair.png" height="90px" width="300px"/>
    </div>
    <div class="copyright">
        <p style="color: #ffffff;">©<?= date("Y") ?> Trip’Horizon par Fablec Maëlle, Bruche Julie et <a href="https://fulldevspirit.fr">Marmaroli Eléa</a></p>
    </div>
    <p style="color: #ffffff;">Ce site est un site fictif à but pédagogique</p>
</footer>
<script>
  window.addEventListener("load", () => {
    const loader = document.getElementById("loader");
    setTimeout(() => {
      loader.classList.add("hidden");
    }, 800);
  });
  
</script>
</body>
</html>
