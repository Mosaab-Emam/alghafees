import { router } from "@inertiajs/react";
import ButtonsBox from "../../ButtonsBox";
import WebsiteLinks from "../WebsiteLinks";

const links = [
    { id: 1, name: "الرئيسية", to: "/" },
    { id: 2, name: "من نحن", to: "/about-us" },
    { id: 3, name: "خدماتنا", to: "/our-services" },
    { id: 4, name: "عملاؤنا", to: "/our-clients" },
    { id: 5, name: "الأسعار", to: "/pricing" },
    { id: 6, name: "طلب تقييم ", to: "/request-evaluation" },
    { id: 7, name: "الأسئلة الشائعة", to: "/faq" },
];

export default function DesktopMenu() {
    return (
        <div className="w-full md:flex justify-between hidden">
            <WebsiteLinks links={links} />

            <ButtonsBox
                className="hidden lg:flex"
                primaryBtnContent={"انضم إلينا"}
                primaryButtonOnClick={() => router.visit("/join-us")}
                outlineBtnContent={"تتبع طلبك "}
                outLinButtonOnClick={() => router.visit("/track-your-request")}
            />
        </div>
    );
}
