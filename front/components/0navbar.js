const Navbar = {
  template: `
  <nav class="bg-gray-800 text-white p-4">
    <template>
        <header class="flex flex-col justify-center px-16 py-4 w-full bg-white border-b border-solid border-b-black max-md:px-5 max-md:max-w-full">
          <nav class="flex gap-5 justify-center items-center w-full max-md:flex-wrap max-md:mr-1 max-md:max-w-full">
            <div class="flex flex-col flex-1 justify-center items-start self-stretch my-auto max-md:max-w-full">
              <img loading="lazy" src="../assets/images/test.jpg" alt="Image de villa" class="aspect-[2.33] w-[63px]" />
            </div>
            <ul class="flex gap-5 justify-between self-stretch my-auto text-base leading-6 text-black whitespace-nowrap">
              <li>Accueil</li>
              <li>Logements</li>
              <li>Services</li>
              <li class="flex gap-1 justify-center">
                <span>Plus</span>
                <img loading="lazy" src="../assets/images/test.jpg" alt="Expand icon" class="shrink-0 w-6 aspect-square" />
              </li>
            </ul>
            <div class="flex flex-col flex-1 justify-center items-end self-stretch px-16 text-base leading-6 text-white whitespace-nowrap max-md:max-w-full">
              <button class="justify-center px-5 py-2 bg-black border border-black border-solid">
                Réserver
              </button>
            </div>
          </nav>
        </header>
    </template>
  </nav>
  `,
};