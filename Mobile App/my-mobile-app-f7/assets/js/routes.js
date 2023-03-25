const baseUrl =
  "http://localhost/latihan/kumpulan-latihan-mobile-app/my-mobile-app-f7/";
var routes = [
  {
    path: "/",
    url: "./index.html",
    name: "login",
  },
  {
    path: `/home/`,
    url: `./pages/home.html`,
    name: "home",
  },

  // Default route (404 page). MUST BE THE LAST
  {
    path: "(.*)",
    url: "./pages/404.html",
  },
];
