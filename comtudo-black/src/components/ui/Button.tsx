import React from "react";
import { motion } from "motion/react";
import { ArrowRight } from "lucide-react";

interface ButtonProps extends React.ComponentProps<"button"> {
  variant?: "primary" | "outline" | "ghost";
  size?: "sm" | "md" | "lg";
  icon?: React.ReactNode;
  children?: React.ReactNode;
  className?: string;
}

export function Button({ 
  children, 
  variant = "primary", 
  size = "md", 
  className = "", 
  icon,
  ...props 
}: ButtonProps) {
  const baseStyles = "inline-flex items-center justify-center rounded-full font-medium transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 disabled:opacity-50 disabled:pointer-events-none";
  
  const variants = {
    primary: "bg-black text-white hover:bg-gray-800 focus:ring-black",
    outline: "border border-current bg-transparent hover:bg-black/5 focus:ring-black",
    ghost: "bg-transparent hover:bg-black/5 text-current focus:ring-black",
  };
  
  const sizes = {
    sm: "h-9 px-4 text-xs uppercase tracking-wider",
    md: "h-11 px-6 text-sm uppercase tracking-wider",
    lg: "h-14 px-8 text-base uppercase tracking-wider",
  };

  return (
    <motion.button
      whileHover={{ scale: 1.02 }}
      whileTap={{ scale: 0.98 }}
      className={`${baseStyles} ${variants[variant]} ${sizes[size]} ${className}`}
      {...props}
    >
      {children}
      {icon && <span className="ml-2">{icon}</span>}
    </motion.button>
  );
}
