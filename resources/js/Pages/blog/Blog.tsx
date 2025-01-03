import { useEffect } from "react";
import { PageTopSection } from "../../components";
import Layout from "../layout/Layout";
import BlogMainContent from "./BlogMainContent";

const Blog = () => {
    useEffect(() => {
        window.scrollTo(0, 0);
    }, []);

    return (
        <Layout>
            <PageTopSection title={"المدونة"} description={"نصائح عقارية"} />
            <BlogMainContent />
        </Layout>
    );
};

export default Blog;
