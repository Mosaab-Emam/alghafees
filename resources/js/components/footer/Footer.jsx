import FooterShape from "./FooterShape";
import NewLetter from "./newsLetter/NewsLetter";
import WebSiteInfo from "./webSiteInfo/WebSiteInfo";

import WebsiteLinks from "../navbar/WebsiteLinks";
import AllRightsReserved from "./AllRightsReserved";
import "./Footer.css";
import MobileFooterLinks from "./mobileFooterLinks/MobileFooterLinks";

const links = [
    { id: 1, name: "الرئيسية", to: "/" },
    { id: 2, name: "من نحن", to: "/about-us" },
    { id: 3, name: "خدماتنا", to: "/our-services" },
    { id: 4, name: "عملاؤنا", to: "/our-clients" },
    { id: 5, name: "الأسعار", to: "/pricing" },
    { id: 6, name: "الفعاليات", to: "/events" },
    { id: 7, name: "تواصل معنا", to: "/contact-us" },
    { id: 8, name: "المدونة", to: "/blog" },
    { id: 9, name: "انضم إلينا", to: "/join-us" },
    { id: 10, name: "طلب تقييم ", to: "/request-evaluation" },
    { id: 11, name: "تتبع طلبك", to: "/track-your-request" },
    { id: 12, name: "سياسة الخصوصية", to: "/privacy-policy" },
];

const Footer = () => {
    return (
        <footer className="relative footer-styles">
            <FooterShape />
            <NewLetter className={"lg:flex hidden"} />
            <WebSiteInfo />
            <div className="xl:container 2xl:px-8 xl:mx-auto px-4 sm:px-6 md:pr-2 md:pl-0 lg:px-20 xl:px-0 relative z-[1]">
                <WebsiteLinks hideDropdown={true} links={links} />
                <MobileFooterLinks links={links} />
                <AllRightsReserved />
            </div>

            <div className="footer-bg-image"></div>
        </footer>
    );
};

export default Footer;
