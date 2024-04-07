const Newsletter = {
  template: `
  <nav class="bg-gray-800 text-white p-4">
    <template>
        <section class="flex flex-col justify-center items-start px-16 py-20 w-full bg-white max-md:px-5 max-md:max-w-full">
          <div class="flex flex-col mt-8 mb-2.5 max-w-full w-[768px]">
            <header class="flex flex-col text-black max-md:max-w-full">
              <h1 class="text-5xl font-bold leading-[57.6px] max-md:max-w-full max-md:text-4xl">
                Inscrivez-vous à notre newsletter
              </h1>
              <p class="mt-6 text-lg leading-7 max-md:max-w-full">
                Recevez les mises à jour, les conseils et les nouvelles fonctionnalités
              </p>
            </header>
            <form class="flex flex-col pt-4 mt-4 max-w-full leading-[150%] w-[513px]">
              <div class="flex gap-4 text-base max-md:flex-wrap">
                <label for="email" class="sr-only">Entrez votre email</label>
                <input id="email" type="email" class="flex-1 justify-center p-3 bg-white border border-black border-solid text-stone-500" placeholder="Entrez votre email" aria-label="Entrez votre email" />
                <button type="submit" class="justify-center px-6 py-3 text-white whitespace-nowrap bg-black border border-black border-solid">
                  S'inscrire
                </button>
              </div>
              <p class="mt-4 text-xs text-black max-md:max-w-full">
                En cliquant sur S'inscrire, vous confirmez votre accord avec nos Conditions Générales.
              </p>
            </form>
          </div>
        </section>
    </template>
  </nav>
  `,
};