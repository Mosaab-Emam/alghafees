import ButtonsBox from "../../ButtonsBox";
import WebsiteLinks from "../WebsiteLinks";

const links = [
    { id: 1, name: "الرئيسية", to: "/" },
    { id: 2, name: "من نحن", to: "/about-us" },
    { id: 3, name: "خدماتنا", to: "/our-services" },
    { id: 4, name: "عملاؤنا", to: "/our-clients" },
    { id: 5, name: "الفعاليات", to: "/events" },
    { id: 6, name: "طلب تقييم ", to: "/request-evaluation" },
];

export default function DesktopMenu() {
    return (
        <div className="w-full md:flex justify-between hidden">
            <WebsiteLinks links={links} />

            <ButtonsBox
                outLinButtonOnClick={() =>
                    (window.location.href = "/track-your-request")
                }
                primaryButtonOnClick={() => (window.location.href = "/join-us")}
                outlineBtnContent={"تتبع طلبك "}
                primaryBtnContent={"انضم إلينا"}
            />
        </div>
    );
}
