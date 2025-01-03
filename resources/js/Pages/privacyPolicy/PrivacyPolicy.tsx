import { useEffect } from "react";
import { PageTopSection } from "../../components";
import Layout from "../layout/Layout";

export default function PrivacyPolicy() {
    useEffect(() => {
        window.scrollTo(0, 0);
    }, []);

    return (
        <Layout>
            <PageTopSection
                title={"سياسة الخصوصية"}
                description={"قريباً..."}
            />
            <div className="mt-[6rem] mb-20"></div>
        </Layout>
    );
}
