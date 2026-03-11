import { motion } from "motion/react";

const brands = [
  { name: "Eliane", src: "https://upload.wikimedia.org/wikipedia/commons/thumb/2/2f/Logo_Eliane_Revestimentos.svg/2560px-Logo_Eliane_Revestimentos.svg.png" },
  { name: "Portinari", src: "https://www.ceramicaportinari.com.br/wp-content/themes/portinari/assets/images/logo-portinari.svg" },
  { name: "Kohler", src: "https://upload.wikimedia.org/wikipedia/commons/thumb/5/58/Kohler_Co._logo.svg/2560px-Kohler_Co._logo.svg.png" },
  { name: "Decortiles", src: "https://www.decortiles.com/wp-content/themes/decortiles/assets/images/logo-decortiles.svg" },
  { name: "Ceusa", src: "https://www.ceusa.com.br/wp-content/themes/ceusa/assets/images/logo-ceusa.svg" }
];

export function Brands() {
  // Duplicamos as marcas para criar o efeito de loop infinito perfeito
  const duplicatedBrands = [...brands, ...brands, ...brands, ...brands];

  return (
    <section id="marcas" className="py-24 px-6 bg-[#DADADA] overflow-hidden">
      <div className="max-w-6xl mx-auto">
        <div className="flex items-center justify-center gap-6 mb-20">
          <div className="h-[1px] flex-1 max-w-[200px] bg-black/20"></div>
          <h2 className="text-xl md:text-2xl font-bold uppercase tracking-[0.15em] text-[#1a1a1a]">Marcas e Destaques</h2>
          <div className="h-[1px] flex-1 max-w-[200px] bg-black/20"></div>
        </div>

        <div className="relative flex overflow-hidden mb-20 [mask-image:linear-gradient(to_right,transparent,black_10%,black_90%,transparent)]">
          <motion.div
            animate={{ x: ["0%", "-50%"] }}
            transition={{
              duration: 30,
              ease: "linear",
              repeat: Infinity,
            }}
            className="flex items-center gap-16 md:gap-24 w-max pr-16 md:pr-24"
          >
            {duplicatedBrands.map((brand, index) => (
              <motion.div
                key={index}
                whileHover={{ scale: 1.05 }}
                className="cursor-pointer flex items-center justify-center h-12"
              >
                {/* Using text as fallback since some SVG URLs might block hotlinking */}
                <span className="text-2xl md:text-3xl font-bold text-[#1a1a1a] tracking-tight whitespace-nowrap">
                  {brand.name.toUpperCase()}
                </span>
              </motion.div>
            ))}
          </motion.div>
        </div>

        <div className="flex justify-center">
          <div className="h-[1px] w-full max-w-4xl bg-black/20"></div>
        </div>
      </div>
    </section>
  );
}
