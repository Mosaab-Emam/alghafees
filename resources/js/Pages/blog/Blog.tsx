import { Post, Tag } from "@/types";
import { withColoredText } from "@/utils";
import { staticContext } from "@/utils/contexts";
import { useContext, useEffect } from "react";
import { PageTopSection } from "../../components";
import Layout from "../layout/Layout";
import BlogMainContent from "./BlogMainContent";

type Props = {
    posts: Array<Post>;
    max_pages: number;
    tags: Array<Tag>;
};
const Blog = ({ posts, max_pages, tags }: Props) => {
    const static_content = useContext<Record<string, string>>(staticContext);

    useEffect(() => {
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.has("search") || urlParams.has("tag")) {
            const element = document.getElementById("search-title");
            if (element) element.scrollIntoView({ behavior: "smooth" });
        }
    }, []);

    return (
        <>
            <PageTopSection
                title={static_content["small_top_title"]}
                description={static_content["main_top_title"]}
            />
            <BlogMainContent posts={posts} max_pages={max_pages} tags={tags} />
        </>
    );
};

Blog.layout = (page: React.ReactNode) => <Layout children={page} />;

export default Blog;
