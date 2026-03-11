import { motion } from "motion/react";
import { Layers, Droplets, Bath, LampCeiling, Box } from "lucide-react";

const segments = [
  {
    title: "REVESTIMENTOS DE ALTO PADRÃO",
    items: [
      "Porcelanatos, grandes formatos, superfícies especiais e texturas exclusivas que transformam ambientes em experiências arquitetônicas.",
      "Materiais que aliam tecnologia, resistência e estética contemporânea."
    ],
    icon: <Layers className="w-10 h-10" />,
    highlight: true
  },
  {
    title: "METAIS E LOUÇAS PREMIUM",
    items: [
      "Linhas sofisticadas, acabamentos refinados e design funcional que elevam banheiros e cozinhas a outro nível.",
      "Peças que unem precisão, durabilidade e elegância atemporal."
    ],
    icon: <Droplets className="w-10 h-10" />
  },
  {
    title: "ILUMINAÇÃO",
    items: [
      "Soluções que valorizam volumes, texturas e atmosferas.",
      "Luminárias e sistemas que combinam eficiência e design, criando cenários únicos."
    ],
    icon: <LampCeiling className="w-10 h-10" />
  },
  {
    title: "BANHEIRO E SPA",
    items: [
      "Elementos que transformam o espaço com elegância.",
      "Design, conforto absoluto e materiais de alta performance.",
      "Modelos exclusivos que se destacam pela funcionalidade e estética."
    ],
    icon: <Bath className="w-10 h-10" />
  },
  {
    title: "SUPERFÍCIES ESPECIAIS E MATERIAIS NOBRES",
    items: [
      "Mármores, pedras naturais, texturas e composições que agregam personalidade e autenticidade a cada projeto."
    ],
    icon: <Box className="w-10 h-10" />
  }
];

export function Segments() {
  return (
    <section id="segmentos" className="py-24 px-6 bg-[#DADADA]">
      <div className="max-w-7xl mx-auto">
        <div className="mb-16 text-left">
          <h2 className="text-[42px] font-bold text-black tracking-wide uppercase leading-tight">
            O QUE VOCÊ <br /> ENCONTRA NA <br /> COMTUDO BLACK?
          </h2>
        </div>

        <div className="flex flex-wrap gap-6 justify-center md:justify-start">
          {segments.map((segment, index) => (
            <motion.div
              key={index}
              initial={{ opacity: 0, y: 20 }}
              whileInView={{ opacity: 1, y: 0 }}
              viewport={{ once: true }}
              transition={{ delay: index * 0.1 }}
              className="w-full md:w-[calc(50%-12px)] lg:w-[400px] h-auto lg:h-[450px] p-6 md:p-8 rounded-2xl flex flex-col shrink-0 transition-all duration-300 bg-transparent border border-black hover:bg-white hover:border-transparent hover:shadow-sm active:scale-[0.98]"
            >
              <div className="mb-12 text-black">
                {segment.icon}
              </div>
              
              <h3 className="text-lg font-bold uppercase tracking-wide mb-8 min-h-[56px] flex items-end">
                {segment.title}
              </h3>
              
              <ul className="space-y-4">
                {segment.items.map((item, i) => (
                  <li key={i} className="flex items-start gap-3 text-sm text-black/80 leading-relaxed">
                    <span className="w-1.5 h-1.5 bg-black mt-2 shrink-0" />
                    <span>{item}</span>
                  </li>
                ))}
              </ul>
            </motion.div>
          ))}
        </div>
      </div>
    </section>
  );
}
