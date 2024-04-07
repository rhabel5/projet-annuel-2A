const Acceuil = {
  template: `
  <nav class="bg-gray-800 text-white p-4">
    <template>
        <main class="flex flex-col grow justify-center self-stretch py-20 pr-16 pl-20 max-md:px-5 max-md:max-w-full">
          <section class="flex flex-col mt-56 text-black max-md:mt-10 max-md:max-w-full">
            <h1 class="text-6xl font-bold leading-[67px] max-md:max-w-full max-md:text-4xl max-md:leading-[54px]">
              Bienvenue sur Paris Caretaker Services!
            </h1>
            <p class="mt-6 text-lg leading-7 max-md:max-w-full">
              Trouvez votre logement idéal à Paris ou proposez vos services de nettoyage de logement.
            </p>
          </section>
          <div class="flex gap-4 items-start self-start pt-4 mt-6 text-base leading-6 whitespace-nowrap">
            <button class="justify-center px-6 py-3 text-white bg-black border border-black border-solid max-md:px-5">
              Inscription
            </button>
            <button class="justify-center px-6 py-3 text-black border border-black border-solid max-md:px-5">
              Connexion
            </button>
          </div>
        </main>
    </template>
  </nav>
  `,
};