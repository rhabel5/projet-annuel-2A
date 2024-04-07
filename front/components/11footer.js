const Footer = {
  template: `
  <nav class="bg-gray-800 text-white p-4">
    <template>
        <footer class="flex flex-col px-16 py-20 w-full bg-white max-md:px-5 max-md:max-w-full">
          <div class="pb-2 max-md:max-w-full">
            <div class="flex gap-5 max-md:flex-col max-md:gap-0">
              <section class="flex flex-col w-[44%] max-md:ml-0 max-md:w-full">
                <div class="flex flex-col max-md:mt-10 max-md:max-w-full">
                  <img loading="lazy" src="../assets/images/test.jpg" alt="Image de villa" class="aspect-[2.33] w-[63px]" />
                  <p class="mt-6 text-base leading-6 text-black max-md:max-w-full">
                    Inscrivez-vous à notre newsletter pour rester informé des fonctionnalités et des nouveautés.
                  </p>
                  <form class="flex flex-col mt-6 max-md:max-w-full">
                    <div class="flex gap-4 text-base leading-6 max-md:flex-wrap">
                      <label for="email" class="sr-only">Entrez votre email</label>
                      <input type="email" id="email" placeholder="Entrez votre email" aria-label="Entrez votre email" class="flex-1 justify-center p-3 bg-white border border-black border-solid text-stone-500" />
                      <button type="submit" class="justify-center px-6 py-3 text-black whitespace-nowrap border border-black border-solid max-md:px-5">
                        S'abonner
                      </button>
                    </div>
                    <p class="mt-4 text-xs leading-5 text-black max-md:max-w-full">
                      En vous abonnant, vous acceptez notre politique de confidentialité et donnez votre consentement pour recevoir des mises à jour de notre entreprise.
                    </p>
                  </form>
                </div>
              </section>
              <div class="flex flex-col ml-5 w-[56%] max-md:ml-0 max-md:w-full">
                <div class="grow max-md:mt-10 max-md:max-w-full">
                  <div class="flex gap-5 max-md:flex-col max-md:gap-0">
                    <nav class="flex flex-col w-[33%] max-md:ml-0 max-md:w-full">
                      <div class="flex flex-col leading-[150%] max-md:mt-10">
                        <h3 class="text-base font-semibold text-black">Colonne Un</h3>
                        <ul class="flex flex-col mt-4 text-sm text-black">
                          <li class="justify-center py-2">
                            <a href="#">Lien Un</a>
                          </li>
                          <li class="justify-center py-2">
                            <a href="#">Lien Deux</a>
                          </li>
                          <li class="justify-center py-2">
                            <a href="#">Lien Trois</a>
                          </li>
                          <li class="justify-center py-2">
                            <a href="#">Lien Quatre</a>
                          </li>
                          <li class="justify-center py-2">
                            <a href="#">Lien Cinq</a>
                          </li>
                        </ul>
                      </div>
                    </nav>
                    <nav class="flex flex-col ml-5 w-[33%] max-md:ml-0 max-md:w-full">
                      <div class="flex flex-col leading-[150%] max-md:mt-10">
                        <h3 class="text-base font-semibold text-black">Colonne Deux</h3>
                        <ul class="flex flex-col mt-4 text-sm text-black">
                          <li class="justify-center py-2">
                            <a href="#">Lien Six</a>
                          </li>
                          <li class="justify-center py-2">
                            <a href="#">Lien Sept</a>
                          </li>
                          <li class="justify-center py-2">
                            <a href="#">Lien Huit</a>
                          </li>
                          <li class="justify-center py-2">
                            <a href="#">Lien Neuf</a>
                          </li>
                          <li class="justify-center py-2">
                            <a href="#">Lien Dix</a>
                          </li>
                        </ul>
                      </div>
                    </nav>
                    <div class="flex flex-col ml-5 w-[33%] max-md:ml-0 max-md:w-full">
                      <div class="flex flex-col grow whitespace-nowrap leading-[150%] max-md:mt-10">
                        <h3 class="text-base font-semibold text-black">Suivez-nous</h3>
                        <ul class="flex flex-col mt-4 text-sm text-black">
                          <li class="flex gap-3 py-2">
                            <img loading="lazy" src="../assets/images/test.jpg" alt="Image de villa" class="shrink-0 w-6 aspect-square" />
                            <a href="#">Facebook</a>
                          </li>
                          <li class="flex gap-3 py-2">
                            <img loading="lazy" src="../assets/images/test.jpg" alt="Image de villa" class="shrink-0 w-6 aspect-square" />
                            <a href="#">Instagram</a>
                          </li>
                          <li class="flex gap-3 py-2">
                            <img loading="lazy" src="../assets/images/test.jpg" alt="Image de villa" alt="X icon" class="shrink-0 w-6 aspect-square" />
                            <a href="#">X</a>
                          </li>
                          <li class="flex gap-3 py-2">
                            <img loading="lazy" src="../assets/images/test.jpg" alt="Image de villa" class="shrink-0 w-6 aspect-square" />
                            <a href="#">LinkedIn</a>
                          </li>
                          <li class="flex gap-3 py-2">
                            <img loading="lazy" src="../assets/images/test.jpg" alt="Image de villa" class="shrink-0 w-6 aspect-square" />
                            <a href="#">Youtube</a>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="flex flex-col mt-20 text-sm leading-5 max-md:mt-10 max-md:max-w-full">
            <hr class="shrink-0 h-px bg-black border border-black border-solid max-md:max-w-full" />
            <div class="flex gap-5 justify-between mt-8 w-full max-md:flex-wrap max-md:max-w-full">
              <p class="text-black">© 2023 Relume. Tous droits réservés.</p>
              <ul class="flex gap-5 justify-between text-black max-md:flex-wrap">
                <li>
                  <a href="#" class="underline">Politique de confidentialité</a>
                </li>
                <li>
                  <a href="#" class="underline">Conditions d'utilisation</a>
                </li>
                <li>
                  <a href="#" class="underline">Paramètres des cookies</a>
                </li>
              </ul>
            </div>
          </div>
        </footer>
    </template>
  </nav>
  `,
};