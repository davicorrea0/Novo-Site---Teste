import { useRef, useState } from "react";
import { motion, useScroll, useTransform, AnimatePresence } from "motion/react";
import { ChevronLeft, ChevronRight, Plus, X } from "lucide-react";

export function Carousel() {
  const containerRef = useRef<HTMLDivElement>(null);
  const [currentIndex, setCurrentIndex] = useState(0);
  const [selectedIndex, setSelectedIndex] = useState<number | null>(null);
  const items = [1, 2, 3, 4, 5];
  
  const { scrollYProgress } = useScroll({
    target: containerRef,
    offset: ["start end", "end start"]
  });

  const scrollX = useTransform(scrollYProgress, [0, 1], ["0%", "-15%"]);

  const handlePrev = () => {
    setCurrentIndex((prev) => (prev === 0 ? items.length - 1 : prev - 1));
  };

  const handleNext = () => {
    setCurrentIndex((prev) => (prev === items.length - 1 ? 0 : prev + 1));
  };

  return (
    <>
      <section className="py-20 px-4 md:px-6 bg-[#DADADA] flex justify-center overflow-hidden">
        <div ref={containerRef} className="relative w-full max-w-[1854px] bg-[#1a1a1a] rounded-[2.5rem] py-16 shadow-2xl">
          
          <div className="flex flex-col md:flex-row justify-between items-start md:items-end mb-16 gap-8 px-8 md:px-[max(4rem,calc((100%-1280px)/2))]">
            <h2 className="text-2xl md:text-3xl lg:text-4xl font-bold text-white max-w-3xl uppercase leading-tight tracking-wide">
              DESCUBRA UM ESPAÇO ONDE ACONTECE A UNIÃO PERFEITA ENTRE DESIGN E LUXO, ONDE CADA DETALHE É PENSADO PARA IMPRESSIONAR.
            </h2>
            
            <div className="flex gap-4 shrink-0 z-10">
              <button 
                onClick={handlePrev}
                className="w-12 h-12 rounded-xl border border-white/20 flex items-center justify-center text-white hover:bg-white hover:text-black transition-colors cursor-pointer"
              >
                <ChevronLeft className="w-5 h-5" />
              </button>
              <button 
                onClick={handleNext}
                className="w-12 h-12 rounded-xl border border-white/20 flex items-center justify-center text-white hover:bg-white hover:text-black transition-colors cursor-pointer"
              >
                <ChevronRight className="w-5 h-5" />
              </button>
            </div>
          </div>

          <div className="w-full pl-8 md:pl-[max(4rem,calc((100%-1280px)/2))]">
            {/* Mobile Carousel */}
            <motion.div style={{ x: scrollX }} className="md:hidden">
              <motion.div 
                drag="x"
                dragConstraints={{ right: 0, left: -(items.length - 1) * 320 }}
                onDragEnd={(_, info) => {
                  if (info.offset.x < -50 && currentIndex < items.length - 1) {
                    handleNext();
                  } else if (info.offset.x > 50 && currentIndex > 0) {
                    handlePrev();
                  }
                }}
                animate={{ x: `-${currentIndex * 320}px` }}
                transition={{ type: "spring", stiffness: 300, damping: 30 }}
                className="flex gap-6 w-max pr-8 cursor-grab active:cursor-grabbing"
              >
                {items.map((item, index) => (
                  <div 
                    key={item} 
                    className="w-[300px] h-[300px] shrink-0 rounded-xl overflow-hidden relative group cursor-pointer"
                    onClick={() => setSelectedIndex(index)}
                  >
                     <img 
                      src={`https://picsum.photos/seed/discover${item}/1080/1080`} 
                      alt="Project" 
                      className="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                    />
                    <div className="absolute top-4 right-4 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <div className="w-8 h-8 bg-white rounded-full flex items-center justify-center shadow-lg">
                            <Plus className="w-5 h-5 text-black" />
                        </div>
                    </div>
                  </div>
                ))}
              </motion.div>
            </motion.div>

            {/* Desktop Carousel */}
            <motion.div style={{ x: scrollX }} className="hidden md:block">
              <motion.div 
                animate={{ x: `-${currentIndex * 564}px` }}
                transition={{ type: "spring", stiffness: 300, damping: 30 }}
                className="flex gap-6 w-max pr-16"
              >
                {items.map((item, index) => (
                  <div 
                    key={item} 
                    className="w-[540px] h-[540px] shrink-0 rounded-xl overflow-hidden relative group cursor-pointer"
                    onClick={() => setSelectedIndex(index)}
                  >
                     <img 
                      src={`https://picsum.photos/seed/discover${item}/1080/1080`} 
                      alt="Project" 
                      className="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                    />
                    <div className="absolute top-4 right-4 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <div className="w-8 h-8 bg-white rounded-full flex items-center justify-center shadow-lg">
                            <Plus className="w-5 h-5 text-black" />
                        </div>
                    </div>
                  </div>
                ))}
              </motion.div>
            </motion.div>
          </div>

        </div>
      </section>

      {/* Lightbox Modal */}
      <AnimatePresence>
        {selectedIndex !== null && (
          <motion.div
            initial={{ opacity: 0 }}
            animate={{ opacity: 1 }}
            exit={{ opacity: 0 }}
            onClick={() => setSelectedIndex(null)}
            className="fixed inset-0 z-[200] bg-black/90 backdrop-blur-sm flex items-center justify-center p-4 md:p-8 cursor-pointer"
          >
            <button 
              onClick={() => setSelectedIndex(null)}
              className="absolute top-6 right-6 md:top-8 md:right-8 w-12 h-12 rounded-xl border border-white/20 flex items-center justify-center text-white hover:bg-white hover:text-black transition-colors z-50"
            >
              <X className="w-5 h-5" />
            </button>

            <button 
              onClick={(e) => { e.stopPropagation(); setSelectedIndex(selectedIndex === 0 ? items.length - 1 : selectedIndex - 1); }}
              className="absolute left-4 md:left-8 top-1/2 -translate-y-1/2 w-12 h-12 rounded-xl border border-white/20 flex items-center justify-center text-white hover:bg-white hover:text-black transition-colors z-50"
            >
              <ChevronLeft className="w-5 h-5" />
            </button>

            <button 
              onClick={(e) => { e.stopPropagation(); setSelectedIndex(selectedIndex === items.length - 1 ? 0 : selectedIndex + 1); }}
              className="absolute right-4 md:right-8 top-1/2 -translate-y-1/2 w-12 h-12 rounded-xl border border-white/20 flex items-center justify-center text-white hover:bg-white hover:text-black transition-colors z-50"
            >
              <ChevronRight className="w-5 h-5" />
            </button>
            
            <AnimatePresence mode="wait">
              <motion.img
                key={selectedIndex}
                initial={{ scale: 0.9, opacity: 0 }}
                animate={{ scale: 1, opacity: 1 }}
                exit={{ scale: 0.9, opacity: 0 }}
                transition={{ type: "spring", damping: 25, stiffness: 300 }}
                src={`https://picsum.photos/seed/discover${items[selectedIndex]}/1080/1080`}
                alt="Enlarged project view"
                className="max-w-full max-h-full object-contain rounded-lg shadow-2xl"
                onClick={(e) => e.stopPropagation()} // Prevent closing when clicking the image itself
              />
            </AnimatePresence>
          </motion.div>
        )}
      </AnimatePresence>
    </>
  );
}
