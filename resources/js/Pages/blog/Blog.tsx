import { Post, Tag } from "@/types";
import { withColoredText } from "@/utils";
import { staticContext } from "@/utils/contexts";
import { useEffect } from "react";
import { PageTopSection } from "../../components";
import Layout from "../layout/Layout";
import BlogMainContent from "./BlogMainContent";

const Blog = ({
    static_content,
    posts,
    max_pages,
    tags,
}: {
    static_content: Record<string, string>;
    posts: Array<Post>;
    max_pages: number;
    tags: Array<Tag>;
}) => {
    for (let [key, value] of Object.entries(static_content)) {
        static_content[key] = withColoredText(value.toString());
    }

    useEffect(() => {
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.has("search") || urlParams.has("tag")) {
            const element = document.getElementById("search-title");
            if (element) element.scrollIntoView({ behavior: "smooth" });
        }
    }, []);

    return (
        <staticContext.Provider value={static_content}>
            <PageTopSection
                title={static_content["small_top_title"]}
                description={static_content["main_top_title"]}
            />
            <BlogMainContent posts={posts} max_pages={max_pages} tags={tags} />
        </staticContext.Provider>
    );
};

Blog.layout = (page: React.ReactNode) => <Layout children={page} />;

export default Blog;
