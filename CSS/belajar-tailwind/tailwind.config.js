module.exports = {
  content: ["./public/**/*.{html,js}"],
  darkMode: "class",
  theme: {
    extend: {
      spacing: {
        13: "3.25rem",
      },
      fontFamily: {
        inter: ["Inter"],
      },
      colors: {
        wpu: "#bada55",
      },
      animation: {
        "spin-slow": "spin 3s linear infinite",
        goyang: "goyang 1s ease-in-out infinite",
      },
      keyframes: {
        goyang: {
          "0%, 100%": {
            transform: "rotate(-3 deg)",
          },
          "50%": {
            transform: "rotate(3deg)",
          },
        },
      },
    },
  },
  plugins: [],
};
