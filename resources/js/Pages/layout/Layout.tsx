import { withColoredText } from "@/utils";
import { staticContext } from "@/utils/contexts";
import { usePage } from "@inertiajs/react";
import { useEffect } from "react";
import { Footer, Navbar, ScrollProgress } from "../../components";
import WhatsappFab from "../../components/WhatsappFab.jsx";
import NewLetter from "../../components/footer/newsLetter/NewsLetter.jsx";

export default function Layout({ children }: { children: React.ReactNode }) {
    const page = usePage();
    document.title = page.props.title as string;

    if (page.props.path === "/" || page.props.path === "request-evaluation") {
        useEffect(() => {
            const custom_gtag = page.props.custom_gtag;
            const script_src = `https://www.googletagmanager.com/gtag/js?id=${custom_gtag}`;
            if (!document.querySelector(`script[src="${script_src}"]`)) {
                const script_tag_1 = document.createElement("script");
                script_tag_1.async = true;
                script_tag_1.src = `https://www.googletagmanager.com/gtag/js?id=${custom_gtag}`;
                document.head.appendChild(script_tag_1);

                const script_tag_2 = document.createElement("script");
                script_tag_2.innerHTML = `
        window.dataLayer = window.dataLayer || [];
        function gtag() { dataLayer.push(arguments); }
        gtag('js', new Date());
        gtag('config', '${custom_gtag}');
    `;
                document.head.appendChild(script_tag_2);
            }
        }, []);
    }

    let static_content: Record<string, string> = {};
    if (children && typeof children === "object" && "props" in children)
        static_content = children.props.static_content || {};

    for (let [key, value] of Object.entries(static_content)) {
        static_content[key] = withColoredText(value.toString());
    }

    return (
        <staticContext.Provider value={static_content}>
            <div className="flex flex-col min-h-screen relative overflow-hidden mx-auto">
                <ScrollProgress />
                <Navbar />
                <main className="flex-grow">{children}</main>
                <WhatsappFab />
                <NewLetter className="flex lg:hidden" />
                <Footer />
            </div>
        </staticContext.Provider>
    );
}
