package etl;

import java.io.BufferedReader;
import java.io.BufferedWriter;
import java.io.File;
import java.io.FileReader;
import java.io.FileWriter;
import java.text.DateFormat;
import java.text.ParseException;
import java.text.SimpleDateFormat;
import java.util.Date;
import java.util.TimeZone;

import org.json.JSONException;
import org.json.JSONObject;

public class ET {

    public static void main(String[] args) throws JSONException, ParseException {
        test();
    }
    
    public static void test() {
        BufferedReader br = null;
        try {
            br = new BufferedReader(new FileReader(new File("o.o")));
            String last = br.readLine().split("\t")[0];
            String s = null;
            int i = 1;
            while ((s = br.readLine()) != null) {
                String[] ss = s.split("\t");
                if (ss[0].equals(last)) {
                    System.err.println(ss[0] + "   " + i);
                }
                last = ss[0];
                ++i;
            }
            System.out.println(i);
        } catch (Exception e) {
            e.printStackTrace();
        } finally {
            try {
                br.close();
            } catch (Exception e) {
                e.printStackTrace();
            }
        }
    }

    public static void extractTransform() {
        BufferedReader br = null;
        BufferedWriter bw = null;
        try {
            br = new BufferedReader(new FileReader(new File("part")));
            bw = new BufferedWriter(new FileWriter(new File("o.o")));
            String s = null;
            while ((s = br.readLine()) != null) {
                JSONObject jo = new JSONObject(s);
                bw.write(((JSONObject) jo.get("user")).getLong("id") + "");
                DateFormat df = new SimpleDateFormat("EEE MMM dd kk:mm:ss z yyyy");
                Date d = df.parse(jo.getString("created_at"));
                DateFormat df2 = new SimpleDateFormat("yyyy-MM-dd+kk:mm:ss");
                df2.setTimeZone(TimeZone.getTimeZone("GMT"));
                bw.write(df2.format(d));
                bw.write("\t" + jo.getLong("id") + "\n");
            }
        } catch (Exception e) {
            e.printStackTrace();
        } finally {
            try {
                br.close();
                bw.close();
            } catch (Exception e) {
                e.printStackTrace();
            }
        }
    }

}
