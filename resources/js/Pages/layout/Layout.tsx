import { Footer, Navbar, ScrollProgress } from "../../components";

import BackToTop from "../../components/BackToTop.jsx";
import NewLetter from "../../components/footer/newsLetter/NewsLetter.jsx";

export default function Layout({ children }: { children: React.ReactNode }) {
    return (
        <div className="flex flex-col min-h-screen relative overflow-hidden max-w-[1440px] mx-auto">
            <ScrollProgress />
            <Navbar />
            <main className="flex-grow">{children}</main>
            <BackToTop />
            <NewLetter className="flex lg:hidden" />
            <Footer />
        </div>
    );
}
