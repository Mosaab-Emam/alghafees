import { PageTopSection } from "../../components";
import Layout from "../layout/Layout";

const PrivacyPolicy = () => (
    <>
        <PageTopSection title={"سياسة الخصوصية"} description={"قريباً..."} />
        <div className="mt-[6rem] mb-20"></div>
    </>
);

PrivacyPolicy.layout = (page: React.ReactNode) => <Layout children={page} />;

export default PrivacyPolicy;
