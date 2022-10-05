import Vue from "vue";
import VueRouter from "vue-router";

Vue.use(VueRouter);

import Home from "./pages/Home";
import About from "./pages/About";
import SingleRestaurant from "./pages/SingleRestaurant";
import Page404 from "./pages/Page404";
import Checkout from "./pages/Checkout";
import Payment from "./pages/Payment";

const router = new VueRouter({
    mode: "history",
    routes: [
        {
            path: "/",
            name: "home",
            component: Home,
        },
        {
            path: "/chi-siamo",
            name: "about",
            component: About,
        },
        {
            path: "/ristorante/:slug",
            name: "single-restaurant",
            component: SingleRestaurant,
        },
        {
            path: "/riepilogo-ordine",
            name: "checkout",
            component: Checkout,
        },
        {
            path: "/pagamento",
            name: "payment",
            component: Payment,
        },
        {
            path: "/*",
            name: "page-404",
            component: Page404,
        },
    ]
});

export default router;