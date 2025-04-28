import { withColoredText } from "@/utils";
import { staticContext } from "@/utils/contexts";
import { Footer, Navbar, ScrollProgress } from "../../components";
import WhatsappFab from "../../components/WhatsappFab.jsx";
import NewLetter from "../../components/footer/newsLetter/NewsLetter.jsx";

export default function Layout({ children }: { children: React.ReactNode }) {
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
