import java.awt.*;
import javax.swing.*;

public class HelloWorld{
	public static void main(String args[]){
		String hello = "Hello World!";
		String welcome = "Welcome To WareSoftAlien Designs";
		
		JOptionPane.showMessageDialog(null, hello, "My custom dialog", JOptionPane.PLAIN_MESSAGE);
		JOptionPane.showMessageDialog(null, welcome, "My custom dialog", JOptionPane.PLAIN_MESSAGE);
	}
}